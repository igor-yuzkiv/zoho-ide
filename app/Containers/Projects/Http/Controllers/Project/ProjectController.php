<?php

namespace App\Containers\Projects\Http\Controllers\Project;

use App\Containers\Projects\Http\Requests\SaveProjectRequest;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transformers\ProjectTransformer;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Spatie\Fractalistic\ArraySerializer;

/**
 *
 */
class ProjectController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getProjects(): JsonResponse
    {
        try {
            return fractal(Project::all())
                ->transformWith(new ProjectTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function getProject(Project $project): JsonResponse
    {
        try {
            return fractal($project)
                ->transformWith(new ProjectTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param SaveProjectRequest $request
     * @return JsonResponse
     */
    public function createProject(SaveProjectRequest $request): JsonResponse
    {
        try {
            //TODO: move to service
            $project = Project::create($request->validated());
            return fractal($project)
                ->transformWith(new ProjectTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    public function updateProject(Project $project, SaveProjectRequest $request): JsonResponse
    {
        try {
            //TODO: move to service
            $project->fill($request->validated());
            $project->save();

            return fractal($project)
                ->transformWith(new ProjectTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function deleteProject(Project $project): JsonResponse
    {
        try {
            $status = $project->delete();
            return response()->json(compact('status'));
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }
}
