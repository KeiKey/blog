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
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
        private UserPolicy $userPolicy
    ) {
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

        return RedirectResponse::success('panel.admin.posts.index',
            Lang::get('general.disable_success', ['name' => $post->title])
        );
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

        return RedirectResponse::success('panel.admin.posts.index',
            Lang::get('general.enable_success', ['name' => $post->title])
        );
    }
}
