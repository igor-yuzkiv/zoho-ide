<?php

namespace App\Containers\Snippets\Http\Controllers;

use App\Containers\Snippets\Presenters\IdeSuggestionsPresenter;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
/**
 *
 */
class SnippetIdeController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function getSuggestions(): JsonResponse{
        $response = (new IdeSuggestionsPresenter())->present();
        return response()->json($response);
    }
}
