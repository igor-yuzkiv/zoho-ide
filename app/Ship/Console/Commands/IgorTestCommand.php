<?php

namespace App\Ship\Console\Commands;

use Illuminate\Console\Command;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';


    public function handle(): void
    {
        $t = null;

        dd(gettype($t));
    }
}
