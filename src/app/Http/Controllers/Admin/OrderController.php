<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request): View
    {
        $query = Order::with(['user', 'items.formation']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Search by order number or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(20);

        // Stats
        $stats = [
            'total' => Order::count(),
            'completed' => Order::completed()->count(),
            'pending' => Order::pending()->count(),
            'failed' => Order::failed()->count(),
            'revenue' => Order::completed()->sum('total'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order): View
    {
        $order->load(['user', 'items.formation', 'downloads']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,failed,refunded',
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->status === 'completed' ? 'paid' : $order->payment_status,
            'completed_at' => $request->status === 'completed' ? now() : $order->completed_at,
        ]);

        return back()->with('success', 'Statut de la commande mis à jour.');
    }

    /**
     * Add a note to the order.
     */
    public function addNote(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'note' => 'required|string|max:1000',
        ]);

        $notes = $order->notes ?? '';
        $notes .= "\n[" . now()->format('d/m/Y H:i') . "] " . $request->note;

        $order->update(['notes' => trim($notes)]);

        return back()->with('success', 'Note ajoutée à la commande.');
    }

    /**
     * Resend order confirmation email.
     */
    public function resendEmail(Order $order): RedirectResponse
    {
        if (!$order->isCompleted()) {
            return back()->with('error', 'Impossible d\'envoyer l\'email pour une commande non complétée.');
        }

        // Mail::to($order->customer_email)->send(new OrderConfirmation($order));

        return back()->with('success', 'Email de confirmation renvoyé.');
    }

    /**
     * Export orders to CSV.
     */
    public function export(Request $request)
    {
        $query = Order::with(['items.formation']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->latest()->get();

        $filename = 'commandes-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($file, [
                'Numéro',
                'Date',
                'Client',
                'Email',
                'Formations',
                'Sous-total',
                'Réduction',
                'Total',
                'Statut',
                'Méthode paiement',
            ], ';');

            foreach ($orders as $order) {
                $formations = $order->items->pluck('formation_name')->join(', ');

                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('d/m/Y H:i'),
                    $order->customer_name,
                    $order->customer_email,
                    $formations,
                    number_format($order->subtotal, 2, ',', ' '),
                    number_format($order->discount, 2, ',', ' '),
                    number_format($order->total, 2, ',', ' '),
                    $order->status_label,
                    $order->payment_method ?? '-',
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
