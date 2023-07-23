<?php

namespace App\Containers\Projects\Transformers;

use App\Containers\Projects\Models\ProjectConnection;
use App\Containers\ZohoAuth\ZohoOAuthClient;
use App\Ship\Utils\TransformersUtil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ConnectionTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * @var array|string[]
     */
    protected array $availableIncludes = ['project'];

    /**
     * @param ProjectConnection $projectConnection
     * @return array
     */
    public function transform(ProjectConnection $projectConnection): array
    {
        return [
            'id'                   => (string)$projectConnection->id,
            'project_id'           => (string)$projectConnection->project_id,
            'status'               => (string)$projectConnection->status,
            'client_id'            => $projectConnection->client_id,
            'client_secret'        => $projectConnection->client_secret,
            'access_token'         => $projectConnection->access_token,
            'refresh_token'        => $projectConnection->refresh_token,
            'data_center'          => $projectConnection->data_center,
            'domain'               => $projectConnection->domain,
            'expire'               => $projectConnection->expire,
            'scopes'               => $projectConnection->scopes,
            'created_at'           => $projectConnection->created_at,
            'updated_at'           => $projectConnection->updated_at,
            'created_at_formatted' => TransformersUtil::dateTimeFormatted($projectConnection->created_at),
            'updated_at_formatted' => TransformersUtil::dateTimeFormatted($projectConnection->updated_at),
        ];
    }

    /**
     * @param ProjectConnection $projectConnection
     * @return Item
     */
    public function includeProject(ProjectConnection $projectConnection): Item
    {
        return $this->item($projectConnection->project, new ProjectTransformer);
    }
}
