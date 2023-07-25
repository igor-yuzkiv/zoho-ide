<?php

namespace Deluge\Crm;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;


class DelugeCrmServiceProvider  extends ServiceProvider
{
    /**
     * Register any application utils.
     */
    public function register(): void
    {
        Blade::componentNamespace('Deluge\\Crm\\Snippets', 'dl-crm');
    }

    /**
     * Bootstrap any application utils.
     */
    public function boot(): void
    {

    }
}
