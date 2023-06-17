<?php

use Illuminate\Support\Facades\Route;

return [
    Route::get("/", [\Zoho\Connect\Http\Controllers\ZohoConnectController::class, "index"]),
    Route::get("callback", [\Zoho\Connect\Http\Controllers\ZohoConnectController::class, "callback"]),
    Route::post("authorization", [\Zoho\Connect\Http\Controllers\ZohoConnectController::class, "authorization"]),
];
