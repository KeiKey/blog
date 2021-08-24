<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

    public function access(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }
}
