<?php

namespace App\Http\Controllers;

use App\Models\Post\Post;
use App\Services\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PostController extends Controller
{
    private $postService;

    public function __construct(
        PostService $postService
    ) {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the post.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('site.posts.index', ['posts' => $this->postService->all()]);
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        return view('site.posts.show', ['post' => $post]);
    }
}
