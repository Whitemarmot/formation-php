<?php

namespace App\Providers;

use App\Models\Cart;
use App\Services\PdfWatermarkService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register PDF Watermark Service
        $this->app->singleton(PdfWatermarkService::class, function ($app) {
            return new PdfWatermarkService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        View::composer('*', function ($view) {
            $view->with('cartCount', Cart::count());
        });
    }
}
