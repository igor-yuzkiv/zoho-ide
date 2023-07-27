<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DelugeLanguageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->componentsRegister();
    }

    public function boot(): void
    {

    }

    private function componentsRegister(): void
    {
        //TODO: реєструвати компоненти через команду в кеш і бд (для редактора), а тоді вже тут
        $namespaces = glob('Deluge/*');

        foreach (glob('Deluge/*') as $component) {
            if (!file_exists($component . '/manifest.php')) {
                continue;
            }

            $manifest = require $component . '/manifest.php';
            if (!is_array($manifest)) {
                continue;
            }

            Blade::componentNamespace($manifest['namespace'], $manifest['prefix']);
        }
    }
}
