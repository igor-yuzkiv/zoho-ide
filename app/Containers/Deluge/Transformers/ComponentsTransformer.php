<?php

namespace App\Containers\Deluge\Transformers;

use App\Containers\Deluge\Models\DelugeComponent;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ComponentsTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * @var array|string[]
     */
    protected array $availableIncludes = ['module'];

    /**
     * @param DelugeComponent $delugeComponent
     * @return array
     */
    public function transform(DelugeComponent $delugeComponent): array
    {
        return [
            'id'          => (string)$delugeComponent->id,
            'name'        => $delugeComponent->name,
            'description' => $delugeComponent->description,
            'insertText'  => $delugeComponent->insertText,
            'attributes'  => $delugeComponent->attributes,
            'slots'       => $delugeComponent->slots,
            'created_at'  => $delugeComponent->created_at,
            'updated_at'  => $delugeComponent->updated_at,
        ];
    }

    /**
     * @param DelugeComponent $delugeComponent
     * @return Item
     */
    public function includeModule(DelugeComponent $delugeComponent): Item
    {
        return $this->item($delugeComponent->module, new ModuleTransformer);
    }
}
