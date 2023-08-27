<?php

namespace App\Containers\Project\Http\Controllers;

use App\Containers\Project\Forms\ProjectForm;
use App\Containers\Project\Model\Project;
use App\Ship\Http\Controllers\Controller;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Fractalistic\ArraySerializer;

/**
 *
 */
class ProjectsController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProjects(Request $request): JsonResponse
    {
        $parseIncludes = [];
        if ($request->has('includes')) {
            $parseIncludes = explode(',', $request->get('includes', ''));
        }

        return fractal(Project::paginate($request->get('per_page', 10)))
            ->transformWith(new ProjectTransformer())
            ->parseIncludes($parseIncludes)
            ->respond();
    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function getProject(Project $project): JsonResponse
    {
        return fractal($project)
            ->transformWith(new ProjectTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    /**
     * @param \Request $request
     * @return JsonResponse
     */
    public function createProject(\Request $request): JsonResponse
    {
        $data = (new ProjectForm())->validate($request->toArray());
        $project = Project::create($data);
        return fractal($project)
            ->transformWith(new ProjectTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    /**
     * @param Project $project
     * @param \Request $request
     * @return JsonResponse
     */
    public function updateProject(Project $project, \Request $request): JsonResponse
    {
        $data = (new ProjectForm())->validate($request->toArray());
        $project->update($data);
        return fractal($project)
            ->transformWith(new ProjectTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function deleteProject(Project $project): JsonResponse
    {
        return response()->json([
            "status" => $project->delete()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getFormMeta(): JsonResponse
    {
        $form = new ProjectForm();
        return $form->respond();
    }

}
