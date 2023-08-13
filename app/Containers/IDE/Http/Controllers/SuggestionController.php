<?php

namespace App\Containers\IDE\Http\Controllers;

use App\Containers\IDE\Presenters\SuggestionPresenter;

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
