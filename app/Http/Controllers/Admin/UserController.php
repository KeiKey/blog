<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.users.index', ['users' => User::withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */
    public function create()
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
        $handler = $this->userService->createUser($request);

        return redirect()->route('panel.admin.users.index')->with($handler['status'], $handler['message']);
    }

    /**
     * Promote a user to admin role.
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function promote(User $user, Request $request): RedirectResponse
    {
        $handler = $this->userService->promoteUser($request->user(), $user);

        return redirect()->route('panel.admin.users.index')->with($handler['status'], $handler['message']);
    }

    /**
     * Disable a user|your account.
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function disable(User $user, Request $request): RedirectResponse
    {
        $handler = $this->userService->disableUser($request->user(), $user);

        return redirect()->route('panel.admin.users.index')->with($handler['status'], $handler['message']);
    }

    /**
     * Enable a user|you account.
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function enable(User $user, Request $request): RedirectResponse
    {
        $handler = $this->userService->enableUser($request->user(), $user);

        return redirect()->route('panel.admin.users.index')->with($handler['status'], $handler['message']);
    }
}
