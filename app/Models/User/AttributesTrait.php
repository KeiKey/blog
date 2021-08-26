<?php

namespace App\Models\User;

use App\Enums\Role;
use App\Enums\State;

trait AttributesTrait
{
    /**
     * Determine if the user is Admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    /**
     * Determine if the user is User
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === Role::USER;
    }

    /**
     * Determine if the user is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->state === State::ACTIVE;
    }
}
