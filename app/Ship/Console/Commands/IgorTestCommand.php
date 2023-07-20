<?php

namespace App\Ship\Console\Commands;

use App\Containers\ZohoServices\Creator\SyncCrmRecordWithCreator;
use Illuminate\Console\Command;

class IgorTestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';


    public function handle(): void
    {
        $snippet = new SyncCrmRecordWithCreator(
            "Accounts",
            [
                "Account_Name" => "Account_Name",
                "First_Name"   => "First_Name",
                "Last_Name"    => "First_Name",
            ],
            "Accounts"
        );

        $code = $snippet->build();

        dd($code);
    }
}
