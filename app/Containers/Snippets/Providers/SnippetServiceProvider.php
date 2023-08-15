<?php

namespace App\Containers\Snippets\Providers;

use App\Containers\Snippets\Utils\SnippetUtil;
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
        Blade::anonymousComponentPath(SnippetUtil::getBasePath());
    }
}
