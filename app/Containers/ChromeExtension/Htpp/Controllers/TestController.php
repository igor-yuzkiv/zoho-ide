<?php

namespace App\Containers\ChromeExtension\Htpp\Controllers;

use App\Containers\Deluge\Apps\ZohoCreator\SyncCrmRecordWithCreator;
use App\Ship\Http\Controllers\Controller;
use App\View\Components\SyncCrmWithCreator;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function inject(): JsonResponse
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


        return response()
            ->json([
                'code' => $code,
            ]);*/


        $map =  [
            "Account_Name" => "Account_Name",
            "First_Name"   => "First_Name",
            "Last_Name"    => "First_Name",
        ];

        $code = (new SyncCrmWithCreator($map))->render()->render();

        return response()
            ->json([
                'code' => $code,
            ]);
    }
}
