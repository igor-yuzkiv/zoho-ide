<?php

namespace App\Containers\ChromeExtension\Http\Controllers;

use App\Containers\Snippets\View\Components\SyncCrmWithCreator;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function inject(): JsonResponse
    {
        $map =  [
            "Account_Name" => "Account_Name",
            "First_Name"   => "First_Name",
            "Last_Name"    => "First_Name",
        ];

        $code = (new SyncCrmWithCreator($map, 'Accounts', 'Accounts'))->render()->render();

        return response()
            ->json([
                'code' => $code,
            ]);
    }
}
