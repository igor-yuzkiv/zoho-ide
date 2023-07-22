<?php

namespace App\Containers\Projects\Transformers;

use App\Containers\Projects\Models\Project;
use App\Ship\Utils\TransformersUtil;
use League\Fractal\TransformerAbstract;
use  \League\Fractal\Resource\Collection;

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
    protected array $availableIncludes = ['connections'];

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
            'updated_at'           => $project->updated_at,
            'created_at_formatted' => TransformersUtil::dateTimeFormatted($project->created_at),
            'updated_at_formatted' => TransformersUtil::dateTimeFormatted($project->updated_at),
        ];
    }

    /**
     * @param Project $project
     * @return Collection
     */
    public function includeConnections(Project $project): Collection
    {
        return $this->collection($project->connections, new ConnectionTransformer());
    }
}
