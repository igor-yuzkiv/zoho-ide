<?php

namespace App\Containers\Snippets\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 *
 */
class SnippetServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {

    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(base_path(config('project.snippets.path')));
    }
}
