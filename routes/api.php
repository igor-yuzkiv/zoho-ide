<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('project/connection/zoho-callback', [\App\Containers\Projects\Http\Controllers\Project\ConnectionController::class, 'zohoCallback']);

Route::prefix("projects")
    ->group(function () {
        Route::get("", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "getProjects"]);
        Route::get("{project}", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "getProject"]);
        Route::post("", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "createProject"]);
        Route::put("{project}", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "updateProject"]);
        Route::delete("{project}", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "deleteProject"]);
        Route::get("{project}/connections", [\App\Containers\Projects\Http\Controllers\Project\ProjectController::class, "getProjectConnections"]);
    });

Route::prefix("deluge")
    ->group(function () {
        Route::prefix("components")
            ->group(function () {
                Route::get("", [\App\Containers\Deluge\Http\Controllers\ComponentsController::class, "getComponents"]);
            });
    });

Route::prefix("snippets")
    ->group(function () {
        Route::get("", [\App\Containers\Snippets\Http\Controllers\SnippetsController::class, "getSnippets"]);
        Route::get("{snippet}", [\App\Containers\Snippets\Http\Controllers\SnippetsController::class, "getSnippetById"]);
        Route::post("", [\App\Containers\Snippets\Http\Controllers\SnippetsController::class, "createSnippet"]);
        Route::put("{snippet}", [\App\Containers\Snippets\Http\Controllers\SnippetsController::class, "updateSnippet"]);
        Route::delete("{snippet}", [\App\Containers\Snippets\Http\Controllers\SnippetsController::class, "deleteSnippet"]);
        Route::post("{snippet}/render", [\App\Containers\Snippets\Http\Controllers\SnippetsController::class, "render"]);
    });

Route::prefix('connections')
    ->group(function () {
        Route::get("{connection}", [\App\Containers\Projects\Http\Controllers\Project\ConnectionController::class, "getConnection"]);
        Route::post("", [\App\Containers\Projects\Http\Controllers\Project\ConnectionController::class, "createConnection"]);
        Route::post("{connection}/authorize", [\App\Containers\Projects\Http\Controllers\Project\ConnectionController::class, "authorizeConnection"]);
        Route::put("{connection}", [\App\Containers\Projects\Http\Controllers\Project\ConnectionController::class, "updateConnection"]);
        Route::delete("{connection}", [\App\Containers\Projects\Http\Controllers\Project\ConnectionController::class, "deleteConnection"]);
    });

Route::prefix('chrome-extension')
    ->group(function () {
        Route::prefix('test')
            ->group(function () {
                Route::post('inject', [App\Containers\ChromeExtension\Http\Controllers\TestController::class, 'inject']);
            });
    });
