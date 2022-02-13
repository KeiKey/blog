<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Policies\UserPolicy;
use App\Services\PostService;
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
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->user()->isUser()) {
            return view('panel.posts.index', ['posts' => $this->postService->getUserPosts(auth()->id())]);
        }

        return redirect()->back()->with('no_access', 'Admin is not allowed to have posts!');
    }

    /**
     * Show the form for creating a new post.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function create(Request $request): View|RedirectResponse
    {
        if ($this->userPolicy->createPost($request->user())) {
            return view('panel.posts.create', ['categories' => Category::all()]);
        }

        return redirect()->back()->with('no_access', 'Admin is not allowed to create posts!');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param PostStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $handler = $this->postService->createPost($request->user());

        return redirect()->route('panel.posts.show', $handler['id'])->with($handler['status'], $handler['message']);
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
        if ($this->userPolicy->accessPost($request->user(), $post)) {
            return view('panel.posts.show', ['post' => $post]);
        }

        return redirect()->route('panel.posts.index')->with('no_access', 'Not Authorized!');
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
        if ($this->userPolicy->createPost($request->user())) {
            return view('panel.posts.edit', ['post' => $post, 'categories' => Category::all()]);
        }

        return redirect()->back()->with('no_access', 'Admin is not allowed to create posts!');
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
        $handler = $this->postService->updatePost($post, $request);

        return redirect()->route('panel.posts.show', $handler['id'])->with($handler['status'], $handler['message']);
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
        $handler = $this->postService->deletePost($request->user(), $post);

        return redirect()->route('panel.posts.index')->with($handler['status'], $handler['message']);
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
        $handler = $this->postService->disablePost($request->user(), $post);

        return redirect()->route('panel.posts.index')->with($handler['status'], $handler['message']);
    }
}
