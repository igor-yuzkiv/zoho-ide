<?php

namespace Zoho\Connect\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ZohoConnectServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migration');

        $this->publishes([
            __DIR__ . '/../../config'          => config_path('zoho'),
            __DIR__ . '/../../resources/views' => resource_path('views/zoho/connection'),
        ]);

        Route::prefix('zoho/connection')
            ->middleware('web')
            ->namespace('Zoho\Connect\Http\Controllers')
            ->group(__DIR__ . '/../../routes/routes.php');
    }
}
