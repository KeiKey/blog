<?php

namespace App\Http\Controllers;

use App\Models\Post\Post;
use App\Services\PostService;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {
    }

    /**
     * Display a listing of the post.
     *
     * @return View
     */
    public function index(): View
    {
        return view('site.posts.index', ['posts' => $this->postService->all()]);
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('site.posts.show', ['post' => $post]);
    }
}
