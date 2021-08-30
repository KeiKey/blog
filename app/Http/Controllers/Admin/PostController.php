<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Policies\UserPolicy;
use App\Services\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    private $postService;

    private $userPolicy;

    public function __construct(
        PostService $postService,
        UserPolicy $userPolicy
    ) {
        $this->userPolicy = $userPolicy;
        $this->postService = $postService;
    }

    /**
     * Display a listing of Posts.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.posts.index', ['posts' => $this->postService->all()]);
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(Post $post, Request $request)
    {
        if ($this->userPolicy->accessPost($request->user(), $post)) {
            return view('admin.posts.show', ['post' => $post]);
        }

        return redirect()->route('admin.posts.index')->with('no_access', 'Not Authorized!');
    }

    /**
     * Disable the specified post.
     *
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function disable(Post $post, Request $request): RedirectResponse
    {
        $handler = $this->postService->disablePost($request->user(), $post);

        return redirect()->route('panel.admin.posts.index')->with($handler['status'], $handler['message']);
    }

    /**
     * Enable a post.
     *
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function enable(Post $post, Request $request): RedirectResponse
    {
        $handler = $this->postService->enablePost($request->user(), $post);

        return redirect()->route('panel.admin.posts.index')->with($handler['status'], $handler['message']);
    }
}
