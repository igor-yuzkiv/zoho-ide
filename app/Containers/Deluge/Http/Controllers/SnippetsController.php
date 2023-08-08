<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Actions\SaveArgumentsAction;
use App\Containers\Deluge\Http\Requests\SaveSnippetRequest;
use App\Containers\Deluge\Models\Snippet\Snippet;
use App\Containers\Deluge\Transformers\Snippet\SnippetTransformer;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Fractalistic\ArraySerializer;

/**
 *
 */
class SnippetsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSnippets(Request $request): JsonResponse
    {
        $parseIncludes = [];
        if ($request->has('includes')) {
            $parseIncludes = explode(',', $request->get('includes', ''));
        }

        $snippets = Snippet::paginate($request->get('per_page', 10));

        return fractal($snippets)
            ->transformWith(new SnippetTransformer())
            ->parseIncludes($parseIncludes)
            ->respond();
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

    /**
     * @param SaveSnippetRequest $request
     * @return JsonResponse
     */
    public function createSnippet(SaveSnippetRequest $request): JsonResponse
    {
        $snippet = Snippet::create($request->validated());
        $arguments = $request->get('arguments');
        if (!empty($arguments)) {
            (new SaveArgumentsAction($snippet, $arguments))->handle();
        }

        return fractal($snippet)
            ->transformWith(new SnippetTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    /**
     * @param Snippet $snippet
     * @param SaveSnippetRequest $request
     * @return JsonResponse
     */
    public function updateSnippet(Snippet $snippet, SaveSnippetRequest $request): JsonResponse
    {
        $snippet->update($request->validated());

        $arguments = $request->get('arguments');
        if (!empty($arguments)) {
            (new SaveArgumentsAction($snippet, $arguments))->handle();
        }

        return fractal($snippet)
            ->transformWith(new SnippetTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    /**
     * @param Snippet $snippet
     * @return JsonResponse
     */
    public function deleteSnippet(Snippet $snippet): JsonResponse
    {
        $status = $snippet->delete();
        return \Response::json(compact('status'));
    }
}
