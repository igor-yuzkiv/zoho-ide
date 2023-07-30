<?php

namespace App\Containers\ChromeExtension\Http\Controllers;

use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function inject(): JsonResponse
    {
        $code = view('test', [
            'crmModuleName' => "Accounts",
            'creatorFromName' => "Accounts",
            'mapping' => [
                'Account_Name' => 'Account_Name',
                'First_Name' => 'First_Name',
                'Last_Name' => 'Last_Name',
            ],
        ])->render();

        return response()->json([
            'code' => $code
        ]);
    }
}
