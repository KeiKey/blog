<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function accessCategory(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

    public function createCategory(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }
}
