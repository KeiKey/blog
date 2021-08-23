<?php

namespace App\Models\Category;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RelationshipTrait
{
    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
