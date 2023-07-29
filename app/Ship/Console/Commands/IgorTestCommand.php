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
        $v = view('test', [
            'crmModuleName' => "Accounts",
            'creatorFromName' => "Accounts",
            'mapping' => [
                'creator_f_1' => 'crm_f_1',
                'creator_f_2' => 'crm_f_2',
            ],
        ]);
        dd($v->render());
    }
}
