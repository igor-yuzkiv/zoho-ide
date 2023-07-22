<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("projects")
    ->group(function () {
        Route::get("", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "getProjects"]);
        Route::get("{project}", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "getProject"]);
        Route::post("", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "createProject"]);
        Route::put("{project}", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "updateProject"]);
        Route::delete("{project}", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "deleteProject"]);
        Route::get("", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "getProjectConnections"]);
    });

Route::prefix('connections')
    ->group(function () {
        Route::post("", [\App\Containers\Projects\Http\Controllers\Project\ProjectConnectionController::class, "createConnection"]);
        Route::put("{connection}", [\App\Containers\Projects\Http\Controllers\Project\ProjectConnectionController::class, "updateConnection"]);
        Route::post("{connection}/authorize", [\App\Containers\Projects\Http\Controllers\Project\ProjectConnectionController::class, "authorizeConnection"]);
    });
