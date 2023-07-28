<?php

namespace App\Containers\Deluge\Transformers;

use App\Containers\Deluge\Models\DelugeComponent;
use League\Fractal\TransformerAbstract;

class ComponentSuggestionsTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function transform(DelugeComponent $delugeComponent): array
    {
        return [
            'name'      => $delugeComponent->name,
            'insertText' => $delugeComponent->insertText,
        ];
    }
}
