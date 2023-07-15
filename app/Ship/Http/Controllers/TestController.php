<?php

namespace App\Ship\Http\Controllers;

use App\Containers\Deluge\ZohoCreator\Snippets\SyncCrmRecordWithCreator;
use App\Containers\Deluge\ZohoCrm\IntegrationTasks\CrmGetRecordByIdTask;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        /* logger()->info(print_r($request->toArray(),true));

         $updateMap = new DelugeMap('updateMap');
         $updateMap->put("Name", "Test Name");
         $updateMap->put("Stage", "Open");

         $insert = "\tnewRecord = insert into Nastya_Test\n\t[";

         $insert .= "\n\t\tFirst_name.first_name = \"Test insert\"";
         $insert .= "\n\t\tEmail = \"test@test.com\"";

         $insert .="\n\t];\n\tinfo newRecord;";*/


        /*$code = "crmId = 4910696000020415001;\n\t";

        $accountResponse = (new ZohoCrmGetRecordById("Accounts", "crmId", "accountResponse"));
        $accountResponseMap = $accountResponse->getMap();


        $code .= $accountResponse->build() . "\n\t";

        $mapping = [
            "Account_Name" => "Account_Name",
            "First_Name"   => "First_Name",
            "Last_Name"    => "First_Name",
        ];

        $code .= "r_Account = insert into Accounts\n\t[";

        foreach ($mapping as $creatorField => $crmField) {
            $code .= "\n\t\t$creatorField = " . $accountResponseMap->get($crmField, '');
        }

        $code .= "\n\t];\n\tinfo r_Account;";*/


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

        return response()
            ->json([
                'code' => $code,
            ]);
    }
}
