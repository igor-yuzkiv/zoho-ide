<?php

namespace App\Ship\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class DelugeLanguageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registryModules();
    }

    public function boot(): void
    {

    }

    private function registryModules(): void
    {
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
