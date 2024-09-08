<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/helpers.php');

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
