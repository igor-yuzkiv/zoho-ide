<?php

namespace App\Containers\Project\Transformers;

use App\Containers\Project\Model\Project;
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
     *
     */
    public function __construct()
    {

    }

    /**
     * @param Project $project
     * @return array
     */
    public function transform(Project $project): array
    {
        return [
            'id'          => (string)$project->id,
            'name'        => $project->name,
            'description' => $project->description,
            'created_at'  => $project->created_at,
            'updated_at'  => $project->updated_at,
        ];
    }
}
