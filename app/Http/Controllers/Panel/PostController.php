<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Policies\UserPolicy;
use App\Services\PostService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('panel.posts.index', ['posts' => $request->user()->posts]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function create(Request $request): View|RedirectResponse
    {
        if (!$this->userPolicy->createPost($request->user())) {
            return RedirectResponse::error(null, 'Admin is not allowed to create posts!');
        }

        return view('panel.posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param PostStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $post = $this->postService->createPost($request);

        return redirect()->route('panel.posts.show', $post->id)->with('success', 'Success!');
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function show(Post $post, Request $request): View|RedirectResponse
    {
        if (!$this->userPolicy->accessPost($request->user(), $post)) {
            return RedirectResponse::error('panel.posts.index', 'Not Authorized!');
        }

        return view('panel.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the post resource.
     *
     * @param Post $post
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function edit(Post $post, Request $request): View|RedirectResponse
    {
        if (!$this->userPolicy->createPost($request->user())) {
            return RedirectResponse::error(null, 'Admin is not allowed to create posts!');
        }

        return view('panel.posts.edit', ['post' => $post, 'categories' => Category::all()]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param Post $post
     * @param PostStoreRequest $request
     * @return RedirectResponse
     */
    public function update(Post $post, PostStoreRequest $request): RedirectResponse
    {
        try {
            $this->postService->updatePost($post, $request);
        } catch(Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return redirect()->route('panel.posts.show', $post->id)->with('success', 'Success!');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Post $post, Request $request): RedirectResponse
    {
        try {
            $this->postService->deletePost($request->user(), $post);
        } catch(Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return RedirectResponse::success('panel.posts.index', 'You deleted the post!');
    }

    /**
     * Disable a post.
     *
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function disable(Post $post, Request $request): RedirectResponse
    {
        try {
            $this->postService->disablePost($request->user(), $post);
        } catch(Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return RedirectResponse::success('panel.posts.index');
    }
}
