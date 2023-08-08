<?php

namespace App\Containers\Deluge\Transformers\Snippet;

use App\Containers\Deluge\Models\Snippet\Snippet;
use App\Ship\Utils\TransformersUtil;
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
            'id'          => (string)$snippet->id,
            'name'        => $snippet->name,
            'content'     => $snippet->content,
            'description' => $snippet->description,
            'created_at'  => $snippet->created_at,
            'updated_at'  => $snippet->updated_at,
            'type'        => $snippet->type->value,
            'updated_at_formatted' => TransformersUtil::dateTimeFormatted($snippet->updated_at),
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
