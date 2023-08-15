<?php

namespace App\Containers\Snippets\Transformers;

use App\Containers\Snippets\Models\Snippet;
use App\Containers\Snippets\Utils\SnippetUtil;
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
            'id'             => (string)$snippet->id,
            'title'          => $snippet->title,
            'description'    => $snippet->description,
            'component_name' => $snippet->component_name,
            'type'           => $snippet->type->value,
            'language'       => $snippet->language?->value,
            'content'        => SnippetUtil::getContent($snippet->component_name),
            'created_at'     => $snippet->created_at,
            'updated_at'     => $snippet->updated_at,
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
