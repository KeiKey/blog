<?php

namespace App\Http\Controllers;

use App\Models\Post\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the post.
     *
     * @return View
     */
    public function index(): View
    {
        return view('site.posts.index', ['posts' => Post::active()->get()]);
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
