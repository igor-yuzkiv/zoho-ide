<?php

namespace App\Containers\Deluge\Transformers;

use App\Containers\Deluge\Models\SnippetArgument;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class SnippetArgumentTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = ['snippet'];

    public function transform(SnippetArgument $snippetArgument): array
    {
        return [
            'id'         => (int)$snippetArgument->id,
            'name'       => $snippetArgument->name,
            'type'       => $snippetArgument->type,
            'default'    => $snippetArgument->default,
            'required'   => (boolean)$snippetArgument->required,
            'deleted_at' => $snippetArgument->deleted_at,
            'created_at' => $snippetArgument->created_at,
            'updated_at' => $snippetArgument->updated_at,
        ];
    }

    public function includeSnippet(SnippetArgument $snippetArgument): Item
    {
        return $this->item($snippetArgument->snippet, new SnippetTransformer);
    }
}
