<?php

namespace App\Abstractions\Filter;

use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
trait HasFilter
{
    /**
     * @param Builder $query
     * @param array|FilterInterface $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array|FilterInterface $filters): Builder
    {
        if ($filters instanceof FilterInterface) {
            return $filters->apply($query);
        }

        foreach ($filters as $item) {
            if ($item instanceof FilterInterface) {
                return $item->apply($query);
            } else {
                throw new \InvalidArgumentException('Invalid filter');
            }
        }

        return $query;
    }
}
