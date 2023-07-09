<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("projects")
    ->group(function () {
        Route::get("", [\App\Containers\Project\Http\Controllers\ProjectController::class, "getProjects"]);
        Route::post("", [\App\Containers\Project\Http\Controllers\ProjectController::class, "createProject"]);
        Route::delete("{project}", [\App\Containers\Project\Http\Controllers\ProjectController::class, "deleteProject"]);
    });

Route::any("test", [\App\Ship\Http\Controllers\TestController::class, 'index']);
