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

        $modelFilters = $this->getModelFilters();

        foreach ($filters as $item) {
            if (is_string($item)) {
                [$name, $attributes] = explode(':', $item);
                $attributes = explode(',', $attributes);

                if (isset($modelFilters[$name])) {
                    $filter = new $modelFilters[$name](...$attributes);
                    $query = $filter->apply($query);
                } else {
                    throw new \InvalidArgumentException('Invalid filter');
                }

                continue;
            }

            if ($item instanceof FilterInterface) {
                $query = $item->apply($query);
                continue;
            }

            throw new \InvalidArgumentException('Invalid filter');
        }

        return $query;
    }

    protected function getModelFilters(): array
    {
        return $this->filters ?? [];
    }
}
