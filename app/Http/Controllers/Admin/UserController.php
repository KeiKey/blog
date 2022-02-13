<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {
    }

    /**
     * Display a listing of users.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.users.index', ['users' => User::withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a user in storage.
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = $this->userService->createUser($request);

        return RedirectResponse::success('panel.admin.users.index', 'You created the user '.$user->name);
    }

    /**
     * Promote a user to admin role.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function promote(User $user): RedirectResponse
    {
        $this->userService->promoteUser(Auth::user(), $user);

        return RedirectResponse::success('panel.admin.users.index', 'You promoted the user ' . $user->name);
    }

    /**
     * Disable a user|your account.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function disable(User $user): RedirectResponse
    {
        $this->userService->disableUser(Auth::user(), $user);

        return RedirectResponse::success('panel.admin.users.index', 'You disabled the user ' . $user->name);
    }

    /**
     * Enable a user|you account.
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function enable(User $user): RedirectResponse
    {
        $this->userService->enableUser(Auth::user(), $user);

        return RedirectResponse::success('panel.admin.users.index', 'You disabled the user ' . $user->name);
    }
}
