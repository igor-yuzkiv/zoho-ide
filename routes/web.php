<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/{all?}', [\App\Ship\Http\Controllers\SpaController::class, 'index'])
    ->where(['all' => '.*']);


// Match all routes that start with node_modules (from Vite)
Route::get('/node_modules/{any}', function ($any) {
//    dd($any);

//    // Disable ssl checks for php
//    $streamContext = stream_context_create([
//        "ssl" => [
//            "verify_peer" => false,
//            "verify_peer_name" => false,
//        ],
//    ]);

    // Fetch the Vite compiled worker module and return it
    return response(file_get_contents(base_path("node_modules/$any"), false, ), 200)
        ->header("Content-Type", "text/javascript");

})->where('any', '(.*)');
