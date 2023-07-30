<?php

namespace App\Containers\Deluge\Transformers;

use App\Containers\Deluge\Models\Snippet;
use League\Fractal\TransformerAbstract;

class SnippetTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function transform(Snippet $snippet): array
    {
        return [
            'id'         => (int)$snippet->id,
            'name'       => $snippet->name,
            'content'    => $snippet->content,
            'arguments'  => $snippet->arguments,
            'created_at' => $snippet->created_at,
            'updated_at' => $snippet->updated_at,
        ];
    }
}
