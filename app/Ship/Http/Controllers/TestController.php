<?php

namespace App\Ship\Http\Controllers;

use App\Containers\Deluge\Variable\DelugeMap;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        logger()->info(print_r($request->toArray(),true));

        $updateMap = new DelugeMap('updateMap');
        $updateMap->put("Name", "Test Name");
        $updateMap->put("Stage", "Open");

        $insert = "\tnewRecord = insert into Nastya_Test\n\t[";

        $insert .= "\n\t\tFirst_name.first_name = \"Test insert\"";
        $insert .= "\n\t\tEmail = \"test@test.com\"";

        $insert .="\n\t];\n\tinfo newRecord;";


        return response()
            ->json([
                'code' => $insert,
            ]);
    }
}
