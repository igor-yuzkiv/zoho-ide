<?php

namespace App\Ship\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';


    public function handle(): void
    {
        $test = view("test")->render();
        dd($test);
    }
}
