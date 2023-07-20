<?php

namespace App\Containers\TaskManager\Transformers;

use App\Containers\TaskManager\Models\Project;
use App\Ship\Utils\TransformersUtil;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ProjectTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * @var array
     */
    protected array $availableIncludes = [];

    /**
     * @param Project $project
     * @return array
     */
    public function transform(Project $project): array
    {
        return [
            'id'                   => (string)$project->id,
            'name'                 => $project->name,
            'created_at'           => $project->created_at,
            'created_at_formatted' => TransformersUtil::dateTimeFormatted($project->created_at),
            'updated_at'           => $project->updated_at,
            'updated_at_formatted' => TransformersUtil::dateTimeFormatted($project->updated_at),
        ];
    }
}
