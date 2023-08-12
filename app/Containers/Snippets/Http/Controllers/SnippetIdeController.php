<?php

namespace App\Containers\Snippets\Http\Controllers;

use App\Containers\Snippets\Presenters\IdeSuggestionsPresenter;
use App\Ship\Http\Controllers\Controller;

class SnippetIdeController extends Controller
{
    public function getSuggestions() {
        $response = (new IdeSuggestionsPresenter())->present();
        return response()->json($response);
    }
}
