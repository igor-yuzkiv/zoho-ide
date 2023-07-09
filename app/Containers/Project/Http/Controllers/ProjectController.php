<?php

namespace App\Containers\Project\Http\Controllers;

use App\Containers\Project\Http\Requests\CreateProjectRequest;
use App\Containers\Project\Models\Project;
use App\Containers\Project\Transformers\ProjectTransformer;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Spatie\Fractalistic\ArraySerializer;

/**
 *
 */
class ProjectController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjects(): \Illuminate\Http\JsonResponse
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
     * @param CreateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProject(CreateProjectRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
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
     * @param CreateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProject(Project $project): \Illuminate\Http\JsonResponse
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
