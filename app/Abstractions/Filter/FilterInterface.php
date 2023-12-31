<?php

namespace App\Abstractions\Filter;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $query): Builder;
}
