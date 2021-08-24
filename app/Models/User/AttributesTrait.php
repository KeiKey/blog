<?php

namespace App\Models\User;

use App\Enums\Role;

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
}
