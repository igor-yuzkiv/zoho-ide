<?php

namespace App\Containers\Snippets\Filters;

use App\Abstractions\Filter\FilterInterface;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

class SnippetTypeFilter implements FilterInterface
{
    public function __construct(private readonly SnippetType $type)
    {

    }

    public function apply($query)
    {
        // TODO: Implement apply() method.
    }
}
