<?php

namespace App\Console\Commands;

use App\Deluge\Variable\DelugeMap;
use Illuminate\Console\Command;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';

    public function handle(): void
    {
        $updateMap = new DelugeMap('updateMap');
        $updateMap->put("Name", "Test Name");
        $updateMap->put("Stage", "Open");


        dd($updateMap->compile());
    }
}
