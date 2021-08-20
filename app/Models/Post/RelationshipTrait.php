<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RelationshipTrait
{
    /**
     * Get the user for the post.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories for the post.
     *
     * @return HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
