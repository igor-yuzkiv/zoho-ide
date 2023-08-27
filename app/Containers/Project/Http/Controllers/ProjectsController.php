<?php

namespace App\Containers\Project\Http\Controllers;

use App\Containers\Project\Forms\ProjectForm;
use App\Containers\Project\Model\Project;
use App\Ship\Http\Controllers\Controller;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\JsonResponse;
use Spatie\Fractalistic\ArraySerializer;

/**
 *
 */
class ProjectsController extends Controller
{
    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function getProject(Project $project) {
        return fractal($project)
            ->transformWith(new ProjectTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }

    /**
     * @param Project|null $project
     * @return JsonResponse
     */
    public function getFormMeta(?Project $project = null): JsonResponse
    {
        $form = new ProjectForm($project);
        return $form->respond();
    }
}
