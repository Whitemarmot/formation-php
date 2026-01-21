<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    protected const SESSION_KEY = 'cart';

    /**
     * Get all items in the cart.
     */
    public static function all(): Collection
    {
        return collect(Session::get(self::SESSION_KEY, []));
    }

    /**
     * Add a formation to the cart.
     */
    public static function add(Formation $formation): void
    {
        $cart = self::all();

        // Check if formation is already in cart
        if (!$cart->has($formation->id)) {
            $cart->put($formation->id, [
                'formation_id' => $formation->id,
                'name' => $formation->name,
                'price' => $formation->current_price,
                'original_price' => $formation->price,
                'slug' => $formation->slug,
                'level' => $formation->level,
            ]);

            Session::put(self::SESSION_KEY, $cart->toArray());
        }
    }

    /**
     * Remove a formation from the cart.
     */
    public static function remove(int $formationId): void
    {
        $cart = self::all();
        $cart->forget($formationId);
        Session::put(self::SESSION_KEY, $cart->toArray());
    }

    /**
     * Clear the entire cart.
     */
    public static function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Get the number of items in the cart.
     */
    public static function count(): int
    {
        return self::all()->count();
    }

    /**
     * Check if cart is empty.
     */
    public static function isEmpty(): bool
    {
        return self::count() === 0;
    }

    /**
     * Check if a formation is in the cart.
     */
    public static function has(int $formationId): bool
    {
        return self::all()->has($formationId);
    }

    /**
     * Get the subtotal (sum of all item prices).
     */
    public static function subtotal(): float
    {
        return self::all()->sum('price');
    }

    /**
     * Get the total discount amount.
     */
    public static function discount(): float
    {
        $items = self::all();

        // Check for bundle discount (all 3 formations)
        if ($items->count() >= 3) {
            // 20% discount on bundle
            return self::subtotal() * 0.20;
        }

        return 0;
    }

    /**
     * Get the final total.
     */
    public static function total(): float
    {
        return self::subtotal() - self::discount();
    }

    /**
     * Get cart items with formation models.
     */
    public static function getItemsWithFormations(): Collection
    {
        $formationIds = self::all()->pluck('formation_id');
        $formations = Formation::whereIn('id', $formationIds)->get()->keyBy('id');

        return self::all()->map(function ($item) use ($formations) {
            $item['formation'] = $formations->get($item['formation_id']);
            return $item;
        });
    }

    /**
     * Get formatted subtotal.
     */
    public static function formattedSubtotal(): string
    {
        return number_format(self::subtotal(), 2, ',', ' ') . ' €';
    }

    /**
     * Get formatted discount.
     */
    public static function formattedDiscount(): string
    {
        return number_format(self::discount(), 2, ',', ' ') . ' €';
    }

    /**
     * Get formatted total.
     */
    public static function formattedTotal(): string
    {
        return number_format(self::total(), 2, ',', ' ') . ' €';
    }

    /**
     * Check if bundle discount applies.
     */
    public static function hasBundleDiscount(): bool
    {
        return self::count() >= 3;
    }

    /**
     * Get savings amount (difference between original and current prices + bundle discount).
     */
    public static function savings(): float
    {
        $originalTotal = self::all()->sum('original_price');
        return $originalTotal - self::total();
    }

    /**
     * Get formatted savings.
     */
    public static function formattedSavings(): string
    {
        return number_format(self::savings(), 2, ',', ' ') . ' €';
    }
}
