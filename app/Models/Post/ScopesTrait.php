<?php

namespace App\Models\Post;

use App\Enums\State;
use Illuminate\Database\Eloquent\Builder;

trait ScopesTrait
{
    /**
     * Scope active posts.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('state', State::ACTIVE);
    }
}
