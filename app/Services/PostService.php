<?php

namespace App\Services;

use App\Enums\ResponseStatus;
use App\Enums\State;
use App\Models\Post\Post;
use App\Models\User\User;
use App\Policies\UserPolicy;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;

class PostService
{
    private $response;

    private $userPolicy;

    public function __construct(
        UserPolicy $userPolicy
    ) {
        $this->userPolicy = $userPolicy;
        $this->response = getActionResponse();
    }

    /**
     * Create a post.
     *
     * @param $request
     * @return string[]
     */
    public function createPost($request): array
    {
        if ($this->userPolicy->createPost($request->user())) {
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
                'thumbnail' => $thumbnail_name ? $directory.'/'.$thumbnail_name : null,
                'bg_image' => $bg_image_name ? $directory.'/'.$bg_image_name : null,
                'user_id' => auth()->id()
            ]);

            $this->response = getActionResponse(ResponseStatus::SUCCESS, 'You created this post!');
            $this->response['id'] = $post->id;
        } else {
            $this->response = getActionResponse(ResponseStatus::NO_ACCESS, 'Admin is not allowed to create posts!');

            redirect()->back()->with($this->response['status'], $this->response['message']);
        }

        return $this->response;
    }

    /**
     * Update a post.
     *
     * @param Post $post
     * @param $request
     * @return string[]
     */
    public function updatePost(Post $post, $request): array
    {
        if ($this->userPolicy->createPost($request->user())) {
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

            $this->response = getActionResponse(ResponseStatus::SUCCESS, 'You updated this post!');
            $this->response['id'] = $post->id;
        } else {
            $this->response = getActionResponse(ResponseStatus::NO_ACCESS, 'Admin is not allowed to update posts!');

            redirect()->back()->with($this->response['status'], $this->response['message']);
        }

        return $this->response;
    }

    /**
     * Delete a post - its a soft delete
     *
     * @param User $user
     * @param Post $post
     * @return string[]
     */
    public function deletePost(User $user, Post $post): array
    {
        if ($this->userPolicy->deletePost($user,$post)) {
            $post->update(['state' => State::DELETED]);

            try {
                $title = $post->title;
                $post->delete();

                $this->response = getActionResponse(ResponseStatus::SUCCESS, 'You disabled the post: '. $title .'!');
            } catch (Exception $e) {
                return getActionResponse(ResponseStatus::FAILURE);
            }
        }

        return $this->response;
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
        if ($this->userPolicy->disablePost($user,$post)) {
            $post->update(['state' => State::DISABLED, 'disabled_by' => $user->id]);

            return getActionResponse(ResponseStatus::SUCCESS, 'You disabled the post: '. $post->title.'!');
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
        if ($this->userPolicy->enablePost($user, $post)) {
            $post->update(['state' => State::ACTIVE, 'disabled_by' => null]);

            return getActionResponse(ResponseStatus::SUCCESS, 'You enabled the post: '. $post->title.'!');
        }

        return $this->response;
    }

    /**
     * @param bool $disabled
     * @return Post|Post[]|Builder|Collection|\Illuminate\Database\Query\Builder
     */
    public function all(bool $disabled = false)
    {
        if ($disabled) {
            return Post::withTrashed();
        }

        return Post::all()->where('state', '===', State::ACTIVE);
    }

    /**
     * Get the user corresponding posts.
     *
     * @param $id
     * @param false $disabled
     * @return Post|Post[]|Builder|Collection|\Illuminate\Database\Query\Builder
     */
    public function getUserPosts($id, bool $disabled = false)
    {
        if ($disabled) {
            return Post::withTrashed()->where('user_id',$id);
        }

        return Post::all()->where('user_id',$id);
    }
}
