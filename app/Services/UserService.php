<?php

namespace App\Services;

use App\Enums\Role;
use App\Enums\State;
use App\Exceptions\NotAuthorizedException;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return User::create([
            'name' => ucwords($data['name']),
            'surname' => ucwords($data['surname']),
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Promote a user to admin role.
     *
     * @param User $user
     * @param User $userEdit
     * @return bool
     */
    public function promoteUser(User $user, User $userEdit): bool
    {
        if (!$user->can('promoteUser', $userEdit)) {
            throw new NotAuthorizedException('Not Authorized!');
        }

        return $userEdit->update(['role' => Role::ADMIN, 'disabled_by' => null]);
    }

    /**
     * Disable a user|your account.
     *
     * @param User $user
     * @param User $userEdit
     * @return bool
     */
    public function disableUser(User $user, User $userEdit): bool
    {
        if (!$user->can('disableUser', $userEdit)) {
            throw new NotAuthorizedException('Not Authorized!');
        }

        return $userEdit->update(['state' => State::DISABLED, 'disabled_by' => $user->id]);
    }

    /**
     * Enable a user|your account.
     *
     * @param User $user
     * @param User $userEdit
     * @return bool
     */
    public function enableUser(User $user, User $userEdit): bool
    {
        if (!$user->can('enablesUser', $userEdit)) {
            throw new NotAuthorizedException('Not Authorized!');
        }

        return $userEdit->update(['state' => State::ACTIVE]);
    }
}
