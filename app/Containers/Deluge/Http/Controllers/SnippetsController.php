<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Actions\UpdateSnippetProcedure;
use App\Containers\Deluge\Http\Requests\SaveSnippetRequest;
use App\Containers\Deluge\Models\Snippet\Snippet;
use App\Containers\Deluge\Transformers\Snippet\SnippetTransformer;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Fractalistic\ArraySerializer;

class SnippetsController extends Controller
{
    public function getSnippets()
    {
        //TODO:...
    }

    /**
     * @param Snippet $snippet
     * @param Request $request
     * @return JsonResponse
     */
    public function getSnippetById(Snippet $snippet, Request $request): JsonResponse
    {
        $parseIncludes = [];
        if ($request->has('includes')) {
            $parseIncludes = explode(',', $request->get('includes', ''));
        }

        return fractal($snippet)
            ->transformWith(new SnippetTransformer())
            ->serializeWith(ArraySerializer::class)
            ->parseIncludes($parseIncludes)
            ->respond();
    }

    public function createSnippet(Request $request)
    {
        //TODO:...
    }

    public function updateSnippet(Snippet $snippet, SaveSnippetRequest $request)
    {

        $snippet = (new UpdateSnippetProcedure($snippet, $request->validated()))->handle();
        return fractal($snippet)
            ->transformWith(new SnippetTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    public function deleteSnippet()
    {
        //TODO:...
    }
}
