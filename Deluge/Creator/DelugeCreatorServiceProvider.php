<?php

namespace Deluge\Creator;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DelugeCreatorServiceProvider extends ServiceProvider
{
    /**
     * Register any application utils.
     */
    public function register(): void
    {
        Blade::componentNamespace('Deluge\\Creator\\Snippets', 'dl-creator');
    }

    /**
     * Bootstrap any application utils.
     */
    public function boot(): void
    {

    }
}
