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
     * @param $request
     * @return User
     */
    public function createUser($request): User
    {
        return User::create([
            'name' => ucwords($request->name),
            'surname' => ucwords($request->surname),
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
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
