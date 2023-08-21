<?php

namespace App\Containers\CodeEditor\Http\Controllers;

use App\Containers\CodeEditor\Presenters\SuggestionPresenter;

/**
 *
 */
class SuggestionController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $suggestions = (new SuggestionPresenter())->present();
        return response()->json($suggestions);
    }
}
