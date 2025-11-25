<?php

namespace App\Providers;

use App\Services\BrevoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Brevo service as singleton
        $this->app->singleton(BrevoService::class, function ($app) {
            return new BrevoService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
