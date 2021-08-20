<?php

namespace App\Models\Post;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait RelationshipTrait
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
