<?php

namespace App\Http\Controllers\Guest;

use App\Models\Post\Post;
use App\Services\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

abstract class PostController extends \App\Http\Controllers\PostController
{
    public function __construct(
        PostService $postService
    ) {
        parent::__construct($postService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('posts.index', ['posts' => $this->postService->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }
}
