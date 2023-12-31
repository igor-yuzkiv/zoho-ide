<?php

namespace App\Containers\Snippets\Http\Controllers;

use App\Containers\Snippets\Actions\RenderSnippetAction;
use App\Containers\Snippets\Actions\SaveSnippetProcedure;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Http\Requests\SaveSnippetRequest;
use App\Containers\Snippets\Models\Snippet;
use App\Containers\Snippets\Transformers\SnippetTransformer;
use App\Containers\Snippets\Utils\SnippetUtil;
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

        $snippets = Snippet::query();

        if (is_array($request->get('filter'))) {
            $snippets->filter($request->get('filter'));
        }

        return fractal($snippets->paginate($request->get('per_page', 10)))
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
        $snippet = (new SaveSnippetProcedure($request->getDto()))->handle();
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
        $snippet = (new SaveSnippetProcedure($request->getDto(), $snippet))->handle();
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
            $path = SnippetUtil::getFullPath($snippet->component_name);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        return \Response::json([
            'status' => $snippet->delete()
        ]);
    }

    /**
     * @param Snippet $snippet
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Snippet $snippet, Request $request): JsonResponse
    {
        try {
            $code = (new RenderSnippetAction($snippet, $request->all()))->handle();
            return \Response::json(['status' => true, 'code' => $code]);
        } catch (\Exception $exception) {
            return \Response::json(['status' => false, 'message' => $exception->getMessage()]);
        }
    }
}
