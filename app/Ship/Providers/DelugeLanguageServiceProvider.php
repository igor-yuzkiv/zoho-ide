<?php

namespace App\Ship\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class DelugeLanguageServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->registryModules();
    }

    private function registryModules(): void
    {
        $modules = cache()->get('deluge:modules');
        if (is_array($modules)) {
            foreach ($modules as $component) {
                Blade::componentNamespace($component['namespace'], $component['prefix']);
            }
        }

    }
}
