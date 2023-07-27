<?php

namespace App\Ship\Console\Commands;

use App\Containers\Deluge\Models\DelugeModule;
use Illuminate\Console\Command;

class DelugeRegistryModulesCommand extends Command
{
    protected $signature = 'deluge:registry-modules';

    protected $description = 'Command description';

    public function handle(): void
    {
        $namespaces = glob('Deluge/*');
        foreach (glob('Deluge/*') as $component) {
            if (!file_exists($component . '/manifest.php')) {
                continue;
            }

            $manifest = require $component . '/manifest.php';
            if (!is_array($manifest)) {
                continue;
            }

            $module = DelugeModule::updateOrCreate(
                ['name' => $manifest['name']],
                [
                    "name"      => $manifest['name'],
                    "prefix"    => $manifest['prefix'],
                    "namespace" => $manifest['namespace'],
                ]);


            foreach ($manifest['components'] as $item) {
                $module->components()->updateOrCreate(
                    [
                        'name' => $item['name']
                    ],
                    [
                        "name"        => $item['name'],
                        "description" => \Arr::get($item, 'description'),
                        "insertText"  => $item['insertText'],
                        "attributes"  => $item['attributes'],
                        "slots"       => $item['slots'],
                    ]
                );
            }

        }
    }
}
