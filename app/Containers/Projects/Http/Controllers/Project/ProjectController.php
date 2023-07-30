<?php

namespace App\Containers\Projects\Http\Controllers\Project;

use App\Containers\Projects\Http\Requests\SaveProjectRequest;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transformers\ConnectionTransformer;
use App\Containers\Projects\Transformers\ProjectTransformer;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Fractalistic\ArraySerializer;

/**
 *
 */
class ProjectController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProjects(Request $request): JsonResponse
    {
        try {
            $includes = [];
            if ($request->has('includes')) {
                $includes = explode(',', $request->get('includes'));
            }

            return fractal(Project::all())
                ->transformWith(new ProjectTransformer())
                ->serializeWith(ArraySerializer::class)
                ->parseIncludes($includes)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param Project $project
     * @param Request $request
     * @return JsonResponse
     */
    public function getProject(Project $project, Request $request): JsonResponse
    {
        try {
            $includes = [];
            if ($request->has('includes')) {
                $includes = explode(',', $request->get('includes'));
            }

            return fractal($project)
                ->transformWith(new ProjectTransformer())
                ->parseIncludes($includes)
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

    /**
     * @param Project $project
     * @param SaveProjectRequest $request
     * @return JsonResponse
     */
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

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function getProjectConnections(Project $project): JsonResponse
    {
        try {
            return fractal($project->connections)
                ->transformWith(new ConnectionTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }
}
