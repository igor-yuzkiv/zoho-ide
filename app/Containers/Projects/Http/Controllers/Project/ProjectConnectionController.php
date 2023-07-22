<?php

namespace App\Containers\Projects\Http\Controllers\Project;

use App\Containers\Projects\Models\Project;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Spatie\Fractalistic\ArraySerializer;
use App\Containers\Projects\Transformers\ConnectionTransformer;

class ProjectConnectionController  extends Controller
{
    public function getProjectConnections(Project $project): JsonResponse {
        try {
            return  fractal($project->connections)
                ->transformWith(new ConnectionTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        }catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }
}
