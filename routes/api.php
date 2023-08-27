<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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


Route::prefix("ide")
    ->group(function () {
        Route::get("suggestions", [\App\Containers\CodeEditor\Http\Controllers\SuggestionController::class, "index"]);
    });

Route::prefix("projects")
    ->group(function () {
        Route::get("{project}", [\App\Containers\Project\Http\Controllers\ProjectsController::class, "getProject"]);

        Route::prefix("meta")
            ->group(function () {
                Route::get("form/{project?}", [\App\Containers\Project\Http\Controllers\ProjectsController::class, "getFormMeta"]);
            });
    });
