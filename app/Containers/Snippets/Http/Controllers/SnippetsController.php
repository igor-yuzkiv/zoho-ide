<?php

namespace App\Containers\Snippets\Http\Controllers;

use App\Containers\Snippets\Actions\SaveSnippetProcedure;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Http\Requests\SaveSnippetRequest;
use App\Containers\Snippets\Models\Snippet;
use App\Containers\Snippets\Transformers\SnippetTransformer;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $snippet = (new SaveSnippetProcedure($request->validated()))->handle();
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
        $snippet = (new SaveSnippetProcedure($request->validated(), $snippet))->handle();
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
        if ($snippet->type === SnippetType::TEMPLATE) {
            unlink(base_path(config('project.snippets.components_folder') . '/' . $snippet->component_name . '.blade.php'));
        }
        $status = $snippet->delete();
        return \Response::json(compact('status'));
    }

    /**
     * @param Snippet $snippet
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Snippet $snippet, Request $request): JsonResponse
    {
        if ($snippet->type === SnippetType::SAMPLE) {
            return response()->json(['status' => true, 'code' => $snippet->content]);
        }

        $rules = [];
        foreach ($snippet->arguments as $item) {
            $rules[$item->name] = $item->required ? 'required' : 'nullable';
        }

        $data = $request->validate($rules);
        $code = \Blade::render($snippet->content, $data);

        return response()->json(['status' => true, 'code' => $code]);
    }
}
