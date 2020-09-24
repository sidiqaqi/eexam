<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ExamFilter extends Filter
{
    /**
     * @param string $name
     * @return Builder
     */
    public function name(string $name): Builder
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

    /**
     * @param string $name
     * @return Builder
     */
    public function description(string $name): Builder
    {
        return $this->builder->where('description', 'like', '%' . $name . '%');
    }

    public function search(string $string): Builder
    {
        return $this->builder->where('name', 'like', '%' . $string . '%')
            ->orWhere('description', 'like', '%' . $string . '%');
    }

    /**
     * @param string $id
     * @return Builder
     */
    public function status_id(string $id): Builder
    {
        return $this->builder->where('status_id', $id);
    }

    /**
     * @param string sort_by
     * @return Builder
     */
    public function order_by(string $orderBy): Builder
    {
        $orderType = isset($this->criteria['order_type']) && $this->criteria['order_type'] == 'desc' ? 'desc' : 'asc';

        return $this->builder->orderBy($orderBy, $orderType);
    }
}
