<?php

namespace App\Containers\Snippets\Transformers;

use App\Containers\Snippets\Models\Snippet;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class SnippetTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * @var array
     */
    protected array $availableIncludes = ['arguments'];

    /**
     * @param Snippet $snippet
     * @return array
     */
    public function transform(Snippet $snippet): array
    {
        return [
            'id'                    => (string)$snippet->id,
            'name'                  => $snippet->name,
            'component_name'        => $snippet->component_name,
            'component_insert_text' => $snippet->component_insert_text,
            'content'               => $snippet->getContent(),
            'description'           => $snippet->description,
            'created_at'            => $snippet->created_at,
            'updated_at'            => $snippet->updated_at,
            'type'                  => $snippet->type->value,
        ];
    }

    /**
     * @param Snippet $snippet
     * @return Collection
     */
    public function includeArguments(Snippet $snippet): Collection
    {
        return $this->collection($snippet->arguments, new SnippetArgumentTransformer);
    }
}
