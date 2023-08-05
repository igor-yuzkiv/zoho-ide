<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Http\Requests\SaveArgumentRequest;
use App\Containers\Deluge\Models\Snippet;
use App\Containers\Deluge\Models\SnippetArgument;
use App\Containers\Deluge\Transformers\SnippetArgumentTransformer;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SnippetArgumentController extends Controller
{

    public function getBySnippet(Snippet $snippet)
    {
        //TODO: ...
    }

    /**
     * @param SnippetArgument $argument
     * @return JsonResponse
     */
    public function getById(SnippetArgument $argument): JsonResponse
    {
        return fractal($argument)
            ->transformWith(new SnippetArgumentTransformer())
            ->respond();
    }

    public function createSnippetArgument(Snippet $snippet, SaveArgumentRequest $request)
    {
        $argument = SnippetArgument::create([
            ...$request->validated(),
            'snippet_id' => $snippet->id,
        ]);
        return fractal($argument)
            ->transformWith(new SnippetArgumentTransformer())
            ->respond();
    }

    public function update(SnippetArgument $argument)
    {
        //TODO: ...
    }

    public function delete(SnippetArgument $argument)
    {
        //TODO: ...
    }
}
