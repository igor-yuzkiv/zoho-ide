<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'code' => "updateMap = Map();\n\tupdateMap.put(\"k1\", \"v1\");\n\tupdateMap.put(\"k2\", \"v2\");\n\tinfo updateMap;",
            ]);
    }
}
