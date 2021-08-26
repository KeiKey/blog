<?php

namespace App\Services;

use App\Enums\Role;
use App\Enums\State;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $response;

    public function __construct()
    {
        $this->response = [
            'status' => 'no_access',
            'message' => 'Not Authorized!'
        ];
    }

    /**
     * Create a new user.
     *
     * @param $request
     * @return string[]
     */
    public function createUser($request): array
    {
        $user = User::create([
            'name' => ucwords($request->name),
            'surname' => ucwords($request->surname),
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $this->response['status'] = ['success'];
        $this->response['message'] = ['You created the user '.$user->name .'!'];

        return $this->response;
    }

    /**
     * Promote a user to admin role.
     *
     * @param User $user
     * @param User $userEdit
     * @return string[]
     */
    public function promoteUser(User $user, User $userEdit): array
    {
        if ($user->can('promoteUser', $userEdit)) {
            $userEdit->update(['role' => Role::ADMIN, 'disabled_by' => null]);

            $this->response['status'] = ['success'];
            $this->response['message'] = ['You promoted the user '.$userEdit->name .'!'];
        }

        return $this->response;
    }

    /**
     * Disable a user|your account.
     *
     * @param User $user
     * @param User $userEdit
     * @return string[]
     */
    public function disableUser(User $user, User $userEdit): array
    {
        if ($user->can('disableUser', $userEdit)) {
            $userEdit->update(['state' => State::DISABLED, 'disabled_by' => $user->id]);

            $this->response['status'] = ['success'];
            $this->response['message'] = ['You disabled the user '.$userEdit->name .'!'];
        }

        return $this->response;
    }

    /**
     * Enable a user|you account.,
     *
     * @param User $user
     * @param User $userEdit
     * @return string[]
     */
    public function enableUser(User $user, User $userEdit): array
    {
        if ($user->can('enablesUser', $userEdit)) {
            $userEdit->update(['state' => State::ACTIVE]);

            $this->response['status'] = ['success'];
            $this->response['message'] = ['You enabled the user '.$userEdit->name .'!'];
        }

        return $this->response;
    }
}
