<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\User\User;
use App\Services\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return view('panel.posts.index', ['posts' => $this->postService->getUserPosts(auth()->id())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('panel.posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        return $this->postService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|RedirectResponse|View|void
     */
    public function show(Post $post)
    {
//        dd(toastr()->error('An error has occurred please try again later.'));


        if (auth()->user()->can('accessPost', $post))
            return view('panel.posts.show',['post' => $post]);

        return redirect()->route('panel.posts.index')->with('no_access', 'Not Authorized!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        return view('panel.posts.edit', ['post' => $post, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post): Response
    {
        return redirect()->route('panel.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
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
