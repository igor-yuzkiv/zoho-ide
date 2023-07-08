<?php

use Illuminate\Support\Facades\Route;

return [
    Route::get("/", [\Domain\Zoho\Connect\Http\Controllers\ZohoConnectController::class, "index"]),
    Route::get("callback", [\Domain\Zoho\Connect\Http\Controllers\ZohoConnectController::class, "callback"]),
    Route::post("authorization", [\Domain\Zoho\Connect\Http\Controllers\ZohoConnectController::class, "authorization"]),
];
