<?php

namespace App\Ship\Console\Commands;

use App\Containers\Deluge\Models\Snippet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';


    public function handle(): void
    {
        dd(view('snippets.test1')->render());
    }
}
