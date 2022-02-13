<?php

namespace App\Services;

use App\Enums\State;
use App\Exceptions\NotAuthorizedException;
use App\Models\Post\Post;
use App\Models\User\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\File;

class PostService
{
    public function __construct(
        private UserPolicy $userPolicy
    ) {
    }

    /**
     * Create a post.
     *
     * @param $request
     * @return Post
     */
    public function createPost($request): Post
    {
        if (!$this->userPolicy->createPost($request->user())) {
            throw new NotAuthorizedException('Admin is not allowed to create posts!');
        }

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

        return Post::create([
            'title' => ucwords($request->title),
            'content' => ucwords($request->content),
            'category_id' => (int)$request->category ?? null,
            'thumbnail' => $thumbnail_name ? $directory.'/'.$thumbnail_name : null,
            'bg_image' => $bg_image_name ? $directory.'/'.$bg_image_name : null,
            'user_id' => auth()->id()
        ]);
    }

    /**
     * Update a post.
     *
     * @param Post $post
     * @param $request
     * @return Post
     */
    public function updatePost(Post $post, $request): Post
    {
        if (!$this->userPolicy->createPost($request->user())) {
            throw new NotAuthorizedException('Admin is not allowed to update posts!');
        }

        $directory = str_replace(' ', '_', $request->title);

        if ($request->hasFile('thumbnail')) {
            $extension = $request->thumbnail->extension();
            $thumbnail_name = time().'.'.$extension;
            $request->thumbnail->move(public_path('images/thumbnails/'.$directory), $thumbnail_name);
        }

        if ($request->hasFile('bg_image')) {
            $extension = $request->bg_image->extension();
            $bg_image_name = time().".".$extension;
            $request->bg_image->move(public_path('images/bg_images/'.$directory), $bg_image_name);
        }

        File::delete(public_path('images/thumbnails/'.$directory) .'/'. $post->thumbnail);
        File::delete(public_path('images/bg_images/'.$directory) .'/'. $post->bg_image);

        $post->update([
            'title' => ucwords($request->title),
            'content' => ucwords($request->content),
            'category_id' => (int)$request->category ?? null,
            'thumbnail' => $thumbnail_name ? $directory.'/'.$thumbnail_name : null,
            'bg_image' => $bg_image_name ? $directory.'/'.$bg_image_name : null,
            'user_id' => auth()->id()
        ]);

        return $post;
    }

    /**
     * Delete a post - its a soft delete
     *
     * @param User $user
     * @param Post $post
     * @return Post
     */
    public function deletePost(User $user, Post $post): Post
    {
        if (!$this->userPolicy->deletePost($user, $post)) {
            throw new NotAuthorizedException('Not Authorized!');
        }

        $post->update(['state' => State::DELETED]);

        $post->delete();

        return $post;
    }

    /**
     * Disable a post
     *
     * @param Post $post
     * @param User $user
     * @return Post
     */
    public function disablePost(User $user, Post $post): Post
    {
        if (!$this->userPolicy->disablePost($user, $post)) {
            throw new NotAuthorizedException('Not Authorized!');
        }

        $post->update(['state' => State::DISABLED, 'disabled_by' => $user->id]);

        return $post;
    }

    /**
     * @param Post $post
     * @param User $user
     * @return Post
     */
    public function enablePost(User $user, Post $post): Post
    {
        if (!$this->userPolicy->enablePost($user, $post)) {
            throw new NotAuthorizedException('Not Authorized!');
        }

        $post->update(['state' => State::ACTIVE, 'disabled_by' => null]);

        return $post;
    }
}
