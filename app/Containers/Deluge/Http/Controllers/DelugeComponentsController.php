<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Models\DelugeComponent;
use App\Containers\Deluge\Transformers\ComponentsTransformer;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Fractalistic\ArraySerializer;
use  \Illuminate\Http\JsonResponse;

/**
 *
 */
class DelugeComponentsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getComponents(Request $request): JsonResponse
    {
        $components = DelugeComponent::all();

        $includes = [];
        if ($request->get('include')) {
            $includes = explode(',', $request->get('include'));
        }

        return fractal($components)
            ->transformWith(new ComponentsTransformer())
            ->serializeWith(ArraySerializer::class)
            ->parseIncludes($includes)
            ->respond();
    }
}
