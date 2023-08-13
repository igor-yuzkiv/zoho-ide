<?php

namespace App\Containers\Snippets\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SnippetServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        Blade::anonymousComponentPath(base_path(config('project.snippets.components_folder')));
    }
}
