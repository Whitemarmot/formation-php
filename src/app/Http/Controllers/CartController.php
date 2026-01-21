<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Formation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index(): View
    {
        $items = Cart::getItemsWithFormations();
        $subtotal = Cart::subtotal();
        $discount = Cart::discount();
        $total = Cart::total();
        $hasBundleDiscount = Cart::hasBundleDiscount();
        $savings = Cart::savings();

        return view('cart.index', compact(
            'items',
            'subtotal',
            'discount',
            'total',
            'hasBundleDiscount',
            'savings'
        ));
    }

    /**
     * Add a formation to the cart.
     */
    public function add(Request $request, Formation $formation): RedirectResponse|JsonResponse
    {
        // Check if formation is active
        if (!$formation->is_active) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Cette formation n\'est pas disponible.'], 404);
            }
            return back()->with('error', 'Cette formation n\'est pas disponible.');
        }

        // Check if user already owns this formation
        if (auth()->check() && auth()->user()->ownsFormation($formation)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Vous possédez déjà cette formation.'], 400);
            }
            return back()->with('error', 'Vous possédez déjà cette formation.');
        }

        Cart::add($formation);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Formation ajoutée au panier.',
                'cart_count' => Cart::count(),
                'cart_total' => Cart::formattedTotal(),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Formation ajoutée au panier.');
    }

    /**
     * Remove a formation from the cart.
     */
    public function remove(Request $request, int $formationId): RedirectResponse|JsonResponse
    {
        Cart::remove($formationId);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Formation retirée du panier.',
                'cart_count' => Cart::count(),
                'cart_total' => Cart::formattedTotal(),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Formation retirée du panier.');
    }

    /**
     * Clear the cart.
     */
    public function clear(Request $request): RedirectResponse|JsonResponse
    {
        Cart::clear();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Panier vidé.',
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Panier vidé.');
    }

    /**
     * Add all formations as bundle.
     */
    public function addBundle(Request $request): RedirectResponse|JsonResponse
    {
        $formations = Formation::active()->get();

        foreach ($formations as $formation) {
            // Skip if user already owns this formation
            if (auth()->check() && auth()->user()->ownsFormation($formation)) {
                continue;
            }
            Cart::add($formation);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pack complet ajouté au panier.',
                'cart_count' => Cart::count(),
                'cart_total' => Cart::formattedTotal(),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Pack complet ajouté au panier avec 20% de réduction !');
    }

    /**
     * Get cart count (AJAX).
     */
    public function count(): JsonResponse
    {
        return response()->json([
            'count' => Cart::count(),
            'total' => Cart::formattedTotal(),
        ]);
    }
}
