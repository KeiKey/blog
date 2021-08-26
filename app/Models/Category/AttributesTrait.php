<?php

namespace App\Models\Category;

use App\Enums\State;

trait AttributesTrait
{
    /**
     * Determine if the category is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->state === State::ACTIVE;
    }
}
