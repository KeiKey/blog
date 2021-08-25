<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Models\User\User;
use App\Services\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.posts.index', ['posts' => $this->postService->getUserPosts(auth()->id())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $this->postService;
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function disable(Post $post): RedirectResponse
    {
        return $this->postService->disablePost($post, User::findOrFail(auth()->id()));
    }
}
