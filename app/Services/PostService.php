<?php

namespace App\Services;

use App\Enums\State;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class PostService
{
    private $response;

    public function __construct()
    {
        $this->response = ['no_access', 'Not Authorized!'];
    }

    /**
     * @param $request
     * @return RedirectResponse
     */
    public function create($request): RedirectResponse
    {
        $directory = str_replace(' ', '_', $request->title);
        if ($request->hasFile('thumbnail')) {
            $extension = $request->thumbnail->extension();
            $thumbnail_name = time().".".$extension;
            $request->thumbnail->move(public_path('images/thumbnails/'.$directory), $thumbnail_name);
        }

        if ($request->hasFile('bg_image')) {
            $extension = $request->bg_image->extension();
            $bg_image_name = time().".".$extension;
            $request->bg_image->move(public_path('images/bg_images/'.$directory), $bg_image_name);
        }

        $post = Post::create([
            'title' => ucwords($request->title),
            'content' => ucwords($request->content),
            'category_id' => (int)$request->category ?? null,
            'thumbnail' => $thumbnail_name ?? null,
            'bg_image' => $bg_image_name ?? null,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('panel.posts.show', $post->id)->with('success', 'You created the post!');
    }

    /**
     * @param false $disabled
     * @return Post|Post[]|Builder|Collection|\Illuminate\Database\Query\Builder
     */
    public function all($disabled = false)
    {
        if ($disabled) {
            return Post::withTrashed();
        }

        return Post::all();
    }

    public function getUserPosts($id, $disabled = false)
    {
//        dd(Post::withTrashed()->where('user_id',$id));
        if ($disabled) {
            return Post::withTrashed()->where('user_id',$id);
        }

        return Post::all()->where('user_id',$id);
    }

    /**
     * Disable a post
     *
     * @param Post $post
     * @param User $user
     * @return string[]
     */
    public function disablePost(User $user, Post $post): array
    {
        //todo - fix the policy for the disablePost
//        if ($user->can('disablePost', $post)) {
        if ($user->isAdmin() || $user->id === $post->user_id) {
            $post->update(['state' => State::DISABLED, 'disabled_by' => $user->id]);
            $this->response = ['success', 'You disabled the post: '. $post->title.'!'];
        }

        return $this->response;
    }

    /**
     * @param Post $post
     * @param User $user
     * @return string[]
     */
    public function enablePost(User $user, Post $post): array
    {
        //todo - fix the policy for the enablePost
//        if ($user->can('enablePost', $post)) {
        if ($post->disabled_by === $user->id) {
            $post->update(['state' => State::ACTIVE, 'disabled_by' => null]);
            $this->response = ['success', 'You enabled the post: '. $post->title.'!'];
        }

        return $this->response;
    }
}
