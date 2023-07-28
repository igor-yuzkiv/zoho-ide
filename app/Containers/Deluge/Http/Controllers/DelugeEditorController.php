<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Models\DelugeComponent;
use App\Containers\Deluge\Transformers\ComponentSuggestionsTransformer;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Spatie\Fractalistic\ArraySerializer;
use \Illuminate\Http\JsonResponse;
class DelugeEditorController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getSuggestion(): JsonResponse
    {
        try {
            $components = DelugeComponent::all();

            return  fractal($components)
                ->transformWith(new ComponentSuggestionsTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        }catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }
}
