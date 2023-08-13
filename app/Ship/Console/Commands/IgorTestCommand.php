<?php

namespace App\Ship\Console\Commands;

use App\Containers\Snippets\Models\Snippet;
use Illuminate\Console\Command;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';
    protected $description = 'Command description';


    public function handle(): void
    {
        dd(view('snippets.s-test', ['crmModuleNmae' => 'test', 'creatorFormName' => 'test'])->render());
    }
}
