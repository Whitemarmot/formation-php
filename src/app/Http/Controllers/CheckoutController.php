<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Cart;
use App\Models\Download;
use App\Models\Formation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\PdfWatermarkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Stripe\Webhook;

class CheckoutController extends Controller
{
    protected PdfWatermarkService $pdfService;

    public function __construct(PdfWatermarkService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Secret key for test mode - change this in production!
     */
    protected const TEST_MODE_KEY = 'spotwelding2025';

    /**
     * Display the checkout page.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if (Cart::isEmpty()) {
            return redirect()->route('formations.index')
                ->with('error', 'Votre panier est vide.');
        }

        $items = Cart::getItemsWithFormations();
        $subtotal = Cart::subtotal();
        $discount = Cart::discount();
        $total = Cart::total();
        $hasBundleDiscount = Cart::hasBundleDiscount();

        // Check if test mode is enabled
        $testMode = $request->query('testmode') === self::TEST_MODE_KEY;

        return view('checkout.index', compact(
            'items',
            'subtotal',
            'discount',
            'total',
            'hasBundleDiscount',
            'testMode'
        ));
    }

    /**
     * Process checkout and redirect to payment.
     */
    public function process(Request $request): RedirectResponse
    {
        // Determine allowed payment methods based on test mode
        $allowedMethods = 'stripe,paypal';
        if ($request->query('testmode') === self::TEST_MODE_KEY) {
            $allowedMethods .= ',test';
        }

        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'payment_method' => 'required|in:' . $allowedMethods,
        ]);

        if (Cart::isEmpty()) {
            return redirect()->route('formations.index')
                ->with('error', 'Votre panier est vide.');
        }

        // Create order
        $order = DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'subtotal' => Cart::subtotal(),
                'discount' => Cart::discount(),
                'total' => Cart::total(),
                'payment_method' => $request->payment_method,
                'customer_email' => $request->email,
                'customer_name' => $request->name,
                'billing_address' => [
                    'name' => $request->name,
                    'email' => $request->email,
                ],
            ]);

            // Create order items
            foreach (Cart::all() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'formation_id' => $item['formation_id'],
                    'formation_name' => $item['name'],
                    'quantity' => 1,
                    'unit_price' => $item['price'],
                    'total_price' => $item['price'],
                ]);
            }

            return $order;
        });

        // Redirect to appropriate payment provider
        if ($request->payment_method === 'test') {
            return $this->processTestPayment($order);
        } elseif ($request->payment_method === 'stripe') {
            return $this->createStripeSession($order);
        } else {
            return $this->createPayPalSession($order);
        }
    }

    /**
     * Process test payment (bypass real payment for testing).
     */
    protected function processTestPayment(Order $order): RedirectResponse
    {
        Log::info('Test payment processed', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ]);

        $order->update(['payment_id' => 'TEST_' . uniqid()]);
        $this->completeOrder($order);

        return redirect()->route('checkout.success', ['order' => $order->order_number]);
    }

    /**
     * Create Stripe checkout session.
     */
    protected function createStripeSession(Order $order): RedirectResponse
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($order->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->formation_name,
                        'description' => 'Formation PDF - Soudeuses à Points',
                    ],
                    'unit_amount' => (int) ($item->unit_price * 100),
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Add discount as negative line item if applicable
        if ($order->discount > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Réduction Pack Complet (-20%)',
                    ],
                    'unit_amount' => (int) (-$order->discount * 100),
                ],
                'quantity' => 1,
            ];
        }

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', ['order' => $order->order_number]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel', ['order' => $order->order_number]),
                'customer_email' => $order->customer_email,
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ],
            ]);

            $order->update(['payment_id' => $session->id]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe session creation failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('checkout.index')
                ->with('error', 'Erreur lors de la création de la session de paiement. Veuillez réessayer.');
        }
    }

    /**
     * Create PayPal checkout session.
     */
    protected function createPayPalSession(Order $order): RedirectResponse
    {
        // PayPal integration via srmklive/paypal
        $provider = new \Srmklive\PayPal\Services\PayPal;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'name' => $item->formation_name,
                'unit_amount' => [
                    'currency_code' => 'EUR',
                    'value' => number_format($item->unit_price, 2, '.', ''),
                ],
                'quantity' => $item->quantity,
            ];
        }

        try {
            $response = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'reference_id' => $order->order_number,
                        'amount' => [
                            'currency_code' => 'EUR',
                            'value' => number_format($order->total, 2, '.', ''),
                            'breakdown' => [
                                'item_total' => [
                                    'currency_code' => 'EUR',
                                    'value' => number_format($order->subtotal, 2, '.', ''),
                                ],
                                'discount' => [
                                    'currency_code' => 'EUR',
                                    'value' => number_format($order->discount, 2, '.', ''),
                                ],
                            ],
                        ],
                        'items' => $items,
                    ],
                ],
                'application_context' => [
                    'return_url' => route('checkout.paypal.capture', ['order' => $order->order_number]),
                    'cancel_url' => route('checkout.cancel', ['order' => $order->order_number]),
                    'brand_name' => config('app.name'),
                    'locale' => 'fr-FR',
                ],
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                $order->update(['payment_id' => $response['id']]);

                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect($link['href']);
                    }
                }
            }

            throw new \Exception('PayPal order creation failed');
        } catch (\Exception $e) {
            Log::error('PayPal session creation failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('checkout.index')
                ->with('error', 'Erreur lors de la création de la session PayPal. Veuillez réessayer.');
        }
    }

    /**
     * Handle PayPal payment capture.
     */
    public function capturePayPal(Request $request, string $orderNumber): RedirectResponse
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        $provider = new \Srmklive\PayPal\Services\PayPal;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        try {
            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $this->completeOrder($order);
                return redirect()->route('checkout.success', ['order' => $order->order_number]);
            }

            throw new \Exception('PayPal capture failed');
        } catch (\Exception $e) {
            Log::error('PayPal capture failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            $order->markAsFailed('PayPal capture failed: ' . $e->getMessage());

            return redirect()->route('checkout.cancel', ['order' => $order->order_number])
                ->with('error', 'Le paiement PayPal a échoué.');
        }
    }

    /**
     * Display checkout success page.
     */
    public function success(Request $request, string $orderNumber): View|RedirectResponse
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        // Verify Stripe payment if session_id is present
        if ($request->has('session_id') && $order->payment_method === 'stripe') {
            Stripe::setApiKey(config('services.stripe.secret'));

            try {
                $session = StripeSession::retrieve($request->session_id);

                if ($session->payment_status === 'paid' && $order->isPending()) {
                    $this->completeOrder($order);
                }
            } catch (\Exception $e) {
                Log::error('Stripe session verification failed', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        // Test payments are already completed, no additional verification needed
        if (!$order->isCompleted()) {
            return redirect()->route('checkout.index')
                ->with('error', 'Le paiement n\'a pas été confirmé.');
        }

        // Clear cart
        Cart::clear();

        // Get downloads
        $downloads = $order->downloads()->with('formation')->get();

        // Flag for test mode display
        $isTestPayment = str_starts_with($order->payment_id ?? '', 'TEST_');

        return view('checkout.success', compact('order', 'downloads', 'isTestPayment'));
    }

    /**
     * Display checkout cancel page.
     */
    public function cancel(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return view('checkout.cancel', compact('order'));
    }

    /**
     * Handle Stripe webhook.
     */
    public function stripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $signature, $webhookSecret);
        } catch (\Exception $e) {
            Log::error('Stripe webhook signature verification failed', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $order = Order::where('payment_id', $session->id)->first();

            if ($order && $order->isPending()) {
                $this->completeOrder($order);
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Complete the order and generate downloads.
     */
    protected function completeOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $order->markAsCompleted();

            // Create downloads for each formation
            foreach ($order->items as $item) {
                $watermarkedPath = $this->pdfService->generateWatermarkedPdf(
                    $item->formation,
                    $order->customer_name,
                    $order->customer_email,
                    $order->order_number
                );

                Download::create([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'formation_id' => $item->formation_id,
                    'watermarked_path' => $watermarkedPath,
                    'expires_at' => now()->addDays((int) config('formations.download_expiry_days', 7)),
                ]);
            }
        });

        // Send confirmation email
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order));
            Log::info('Order confirmation email sent', ['order_id' => $order->id, 'email' => $order->customer_email]);
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation email', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }

        Log::info('Order completed', ['order_id' => $order->id, 'order_number' => $order->order_number]);
    }
}
