<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Policies\UserPolicy;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {
    }

    /**
     * Display a listing of Posts.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.posts.index', ['posts' => Post::all()]);
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @param UserPolicy $userPolicy
     * @return View|RedirectResponse
     */
    public function show(Post $post, UserPolicy $userPolicy): View|RedirectResponse
    {
        if ($userPolicy->accessPost(Auth::user(), $post)) {
            return view('admin.posts.show', ['post' => $post]);
        }

        return redirect()->route('admin.posts.index')->with('no_access', 'Not Authorized!');
    }

    /**
     * Disable the specified post.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function disable(Post $post): RedirectResponse
    {
        $this->postService->disablePost(Auth::user(), $post);

        return RedirectResponse::success('panel.admin.posts.index',
            Lang::get('general.disable_success', ['name' => $post->title])
        );
    }

    /**
     * Enable a post.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function enable(Post $post): RedirectResponse
    {
        $this->postService->enablePost(Auth::user(), $post);

        return RedirectResponse::success('panel.admin.posts.index',
            Lang::get('general.enable_success', ['name' => $post->title])
        );
    }
}
