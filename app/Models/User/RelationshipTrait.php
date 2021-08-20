<?php

namespace App\Models\User;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RelationshipTrait
{
    /**
     * Get the posts for the user.
     *
     * @return HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
