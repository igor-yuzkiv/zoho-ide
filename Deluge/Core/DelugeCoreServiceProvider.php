<?php

namespace Deluge\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;


class DelugeCoreServiceProvider  extends ServiceProvider
{
    /**
     * Register any application utils.
     */
    public function register(): void
    {
        Blade::componentNamespace('Deluge\\Core\\Snippets', 'dl');
    }

    /**
     * Bootstrap any application utils.
     */
    public function boot(): void
    {

    }
}
