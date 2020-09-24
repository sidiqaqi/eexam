<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $query
     * @param Filter $filter
     * @return Builder
     * @throws \ReflectionException
     */
    public function scopeFilter(Builder $query, Filter $filter): Builder
    {
        return $filter->apply($query);
    }
}
