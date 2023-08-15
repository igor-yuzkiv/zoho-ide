<?php

namespace App\Containers\Snippets\Transformers;

use App\Containers\Snippets\Models\SnippetArgument;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class SnippetArgumentTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * @var array|string[]
     */
    protected array $availableIncludes = ['snippet'];

    /**
     * @param SnippetArgument $snippetArgument
     * @return array
     */
    public function transform(SnippetArgument $snippetArgument): array
    {
        return [
            'id'          => (string)$snippetArgument->id,
            'snippet_id'  => (string)$snippetArgument->snippet_id,
            'name'        => $snippetArgument->name,
            'type'        => $snippetArgument->type,
            'default'     => $snippetArgument->default,
            'is_required' => (boolean)$snippetArgument->is_required,
            'is_slot'     => (boolean)$snippetArgument->is_slot,
            'created_at'  => $snippetArgument->created_at,
            'updated_at'  => $snippetArgument->updated_at,
        ];
    }

    /**
     * @param SnippetArgument $snippetArgument
     * @return Item
     */
    public function includeSnippet(SnippetArgument $snippetArgument): Item
    {
        return $this->item($snippetArgument->snippet, new SnippetTransformer);
    }
}
