<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait HasOwner
{
    /**
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopeOwner(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }
}
