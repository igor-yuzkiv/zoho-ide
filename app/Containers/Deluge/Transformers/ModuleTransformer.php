<?php

namespace App\Containers\Deluge\Transformers;

use App\Containers\Deluge\Models\DelugeModule;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ModuleTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * @var array|string[]
     */
    protected array $availableIncludes = ['componentsSuggestions'];

    /**
     * @param DelugeModule $delugeModule
     * @return array
     */
    public function transform(DelugeModule $delugeModule): array
    {
        return [
            'id'               => (string)$delugeModule->id,
            'name'             => $delugeModule->name,
            'prefix'           => $delugeModule->prefix,
            'namespace'        => $delugeModule->namespace,
            'created_at'       => $delugeModule->created_at,
            'updated_at'       => $delugeModule->updated_at,
        ];
    }

    /**
     * @param DelugeModule $delugeModule
     * @return Collection
     */
    public function includeComponentsSuggestions(DelugeModule $delugeModule): Collection
    {
        return $this->collection($delugeModule->components, new ComponentSuggestionsTransformer);
    }
}
