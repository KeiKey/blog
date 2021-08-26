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
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.users.index', ['users' => User::withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $handler = $this->userService->create($request);

        return redirect()->route('panel.admin.users.index')->with($handler[0], $handler[1]);
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
        $handler = $this->userService->promote($request->user(), $user);

        return redirect()->route('panel.admin.users.index')->with($handler[0], $handler[1]);
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
        $handler = $this->userService->disable($request->user(), $user);

        return redirect()->route('panel.admin.users.index')->with($handler[0], $handler[1]);
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
        $handler = $this->userService->enable($request->user(), $user);

        return redirect()->route('panel.admin.users.index')->with($handler[0], $handler[1]);
    }
}
