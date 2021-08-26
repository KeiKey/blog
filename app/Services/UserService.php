<?php

namespace App\Services;

use App\Enums\Role;
use App\Enums\State;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new user.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function create($request): RedirectResponse
    {
        $user = User::create([
            'name' => ucwords($request->name),
            'surname' => ucwords($request->surname),
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('panel.admin.users.index')->with('success', 'You created the user '.$user->name .'!');
    }

    /**
     * Promote a user to admin role.
     *
     * @param User $user
     * @param User $userEdit
     * @return string[]
     */
    public function promote(User $user, User $userEdit): array
    {
        $message = ['no_access', 'Not Authorized!'];

        if ($user->can('promoteUser', $userEdit)) {
            $userEdit->update(['role' => Role::ADMIN, 'disabled_by' => null]);
            $message = ['success', 'You promoted the user: '. $userEdit->name.'!'];
        }

        return $message;
    }

    /**
     * Disable a user|your account.
     *
     * @param User $user
     * @param User $userEdit
     * @return string[]
     */
    public function disable(User $user, User $userEdit): array
    {
        $message = ['no_access', 'Not Authorized!'];

        if ($user->can('disableUser', $userEdit)) {
            $userEdit->update(['state' => State::DISABLED, 'disabled_by' => $user->id]);
            $message = ['success', 'You disabled the user: '. $userEdit->name.'!'];
        }

        return $message;
    }

    /**
     * Enable a user|you account.
     *
     * @param User $user
     * @param User $userEdit
     * @return string[]
     */
    public function enable(User $user, User $userEdit): array
    {
        $message = ['no_access', 'Not Authorized!'];

        if ($user->can('enablesUser', $userEdit)) {
            $userEdit->update(['state' => State::ACTIVE]);
            $message = ['success', 'You enabled the user: '. $userEdit->name.'!'];
        }

        return $message;
    }
}
