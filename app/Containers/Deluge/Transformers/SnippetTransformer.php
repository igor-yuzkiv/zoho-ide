<?php

namespace App\Containers\Deluge\Transformers;

use App\Containers\Deluge\Models\Snippet;
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
            'id'              => (int)$snippet->id,
            'name'            => $snippet->name,
            'content'         => $snippet->content,
            'arguments'       => $snippet->arguments,
            'created_at'      => $snippet->created_at,
            'updated_at'      => $snippet->updated_at,
            'arguments_count' => (int)$snippet->arguments_count,
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
