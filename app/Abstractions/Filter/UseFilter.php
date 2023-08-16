<?php

namespace App\Abstractions\Filter;

use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
trait UseFilter
{
    /**
     * @param Builder $query
     * @param array|FilterInterface $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array|FilterInterface $filters): Builder
    {
        if (is_array($filters)) {
            foreach ($filters as $filter) {
                $query = $filter->apply($query);
            }
            return $query;
        }

        return $filters->apply($query);
    }
}
