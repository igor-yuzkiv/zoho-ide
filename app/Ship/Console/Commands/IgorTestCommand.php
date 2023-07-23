<?php

namespace App\Ship\Console\Commands;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Services\Connection\MakeProjectConnection;
use Illuminate\Console\Command;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';


    public function handle(): void
    {
        /*$snippet = new SyncCrmRecordWithCreator(
            "Accounts",
            [
                "Account_Name" => "Account_Name",
                "First_Name"   => "First_Name",
                "Last_Name"    => "First_Name",
            ],
            "Accounts"
        );

        $code = $snippet->build();

        dd($code);*/

        $project = Project::first();
        (new MakeProjectConnection($project))->run();
    }
}
