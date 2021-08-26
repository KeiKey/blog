<?php

namespace App\Models\Post;

use App\Enums\State;

trait AttributesTrait
{

    /**
     * Determine if the post is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->state === State::ACTIVE;
    }
}
