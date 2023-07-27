<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistryDelugeComponentsCommand extends Command
{
    protected $signature = 'registry:deluge-components';

    protected $description = 'Command description';

    public function handle(): void
    {
        $moduleDir = "Deluge";
    }
}
