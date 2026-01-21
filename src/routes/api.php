<?php

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Cart API
Route::prefix('cart')->group(function () {
    Route::get('/count', function () {
        return response()->json([
            'count' => Cart::count(),
            'total' => Cart::formattedTotal(),
        ]);
    });
});
