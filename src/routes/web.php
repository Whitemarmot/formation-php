<?php

use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FormationController as AdminFormationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages
Route::get('/formateur', [HomeController::class, 'formateur'])->name('formateur');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/mentions-legales', [HomeController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/cgv', [HomeController::class, 'cgv'])->name('cgv');
Route::get('/politique-confidentialite', [HomeController::class, 'confidentialite'])->name('confidentialite');

// Formations
Route::prefix('formations')->name('formations.')->group(function () {
    Route::get('/', [FormationController::class, 'index'])->name('index');
    Route::get('/niveau/{level}', [FormationController::class, 'byLevel'])->name('level');
    Route::get('/{slug}', [FormationController::class, 'show'])->name('show');
});

// Cart
Route::prefix('panier')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/ajouter/{formation:slug}', [CartController::class, 'add'])->name('add');
    Route::post('/ajouter-bundle', [CartController::class, 'addBundle'])->name('add-bundle');
    Route::delete('/retirer/{formationId}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/vider', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'count'])->name('count');
});

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
    Route::get('/cancel/{order}', [CheckoutController::class, 'cancel'])->name('cancel');
    Route::get('/paypal/capture/{order}', [CheckoutController::class, 'capturePayPal'])->name('paypal.capture');
});

// Download (token-based protection)
Route::get('/telecharger/{token}', [DownloadController::class, 'download'])
    ->name('download.file');

// Stripe webhook (no CSRF)
Route::post('/webhook/stripe', [CheckoutController::class, 'stripeWebhook'])
    ->name('webhook.stripe')
    ->withoutMiddleware(['web']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Account
    Route::prefix('compte')->name('account.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('account.downloads');
        })->name('index');

        Route::get('/telechargements', [DownloadController::class, 'index'])->name('downloads');
        Route::post('/telechargements/{download}/regenerer', [DownloadController::class, 'regenerate'])
            ->name('downloads.regenerate');

        Route::get('/commandes', function () {
            $orders = auth()->user()->orders()->with('items.formation')->latest()->paginate(10);
            return view('account.orders', compact('orders'));
        })->name('orders');

        Route::get('/profil', [ProfileController::class, 'edit'])->name('profile');
        Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Formations
    Route::resource('formations', AdminFormationController::class);
    Route::post('/formations/{id}/restore', [AdminFormationController::class, 'restore'])->name('formations.restore');
    Route::patch('/formations/{formation}/toggle-active', [AdminFormationController::class, 'toggleActive'])
        ->name('formations.toggle-active');

    // Orders
    Route::get('/commandes', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/commandes/export', [AdminOrderController::class, 'export'])->name('orders.export');
    Route::get('/commandes/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/commandes/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/commandes/{order}/note', [AdminOrderController::class, 'addNote'])->name('orders.add-note');
    Route::post('/commandes/{order}/resend-email', [AdminOrderController::class, 'resendEmail'])->name('orders.resend-email');

    // Customers
    Route::get('/clients', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/clients/export', [AdminCustomerController::class, 'export'])->name('customers.export');
    Route::get('/clients/{customer}', [AdminCustomerController::class, 'show'])->name('customers.show');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
