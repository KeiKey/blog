<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Policies\UserPolicy;
use App\Services\PostService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
        private UserPolicy $userPolicy
    ) {
    }

    /**
     * Display a listing of the posts.
     *
     * @return View
     */
    public function index(): View
    {
        return view('panel.posts.index', ['posts' => Auth::user()->posts]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        if (!$this->userPolicy->createPost(Auth::user())) {
            return RedirectResponse::error(null, 'Admin is not allowed to create posts!');
        }

        return view('panel.posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = $this->postService->createPost($request->validated(), Auth::user());

        return redirect()->route('panel.posts.show', $post->id)->with('success', 'Success!');
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return View|RedirectResponse
     */
    public function show(Post $post): View|RedirectResponse
    {
        if (!$this->userPolicy->accessPost(Auth::user(), $post)) {
            return RedirectResponse::error('panel.posts.index', 'Not Authorized!');
        }

        return view('panel.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the post resource.
     *
     * @param Post $post
     * @return View|RedirectResponse
     */
    public function edit(Post $post): View|RedirectResponse
    {
        if (!$this->userPolicy->createPost(Auth::user())) {
            return RedirectResponse::error(null, 'Admin is not allowed to create posts!');
        }

        return view('panel.posts.edit', ['post' => $post, 'categories' => Category::all()]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        try {
            $this->postService->updatePost($post, $request->validated());
        } catch(Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return redirect()->route('panel.posts.show', $post->id)->with('success', 'Success!');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        try {
            $this->postService->deletePost(Auth::user(), $post);
        } catch(Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return RedirectResponse::success('panel.posts.index', 'You deleted the post!');
    }

    /**
     * Disable a post.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function disable(Post $post): RedirectResponse
    {
        try {
            $this->postService->disablePost(Auth::user(), $post);
        } catch(Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return RedirectResponse::success('panel.posts.index');
    }
}
