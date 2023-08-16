<?php

namespace App\Containers\Snippets\Filters;

use App\Abstractions\Filter\FilterInterface;
use App\Containers\Snippets\Enums\SnippetType;
use Illuminate\Database\Eloquent\Builder;

class SnippetTypeFilter implements FilterInterface
{
    public function __construct(private readonly string|SnippetType $type)
    {

    }

    public function apply(Builder $query): Builder
    {
        return $query->where('type', $this->type);
    }
}
