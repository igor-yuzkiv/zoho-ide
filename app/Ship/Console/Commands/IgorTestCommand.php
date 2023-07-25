<?php

namespace App\Ship\Console\Commands;

use App\Containers\Projects\Enums\ConnectionStatus;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Services\Connection\MakeProjectConnection;
use App\View\Components\SyncCrmWithCreator;
use Illuminate\Console\Command;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';


    public function handle(): void
    {
        $map =  [
            "Account_Name" => "Account_Name",
            "First_Name"   => "First_Name",
            "Last_Name"    => "First_Name",
        ];

        $code = (new SyncCrmWithCreator($map, 'Accounts', 'Accounts'))->render()->render();

        dump($code);
    }
}
