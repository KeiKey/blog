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
     * @param array $data
     * @param User $user
     * @return Post
     */
    public function createPost(array $data, User $user): Post
    {
        $thumbnailName = $data['thumbnail'] ?? $this->storeFile($data, 'thumbnails');

        $backgroundName = $data['bg_image'] ?? $this->storeFile($data, 'bg_images');

        return Post::create([
            'title' => ucwords($data['title']),
            'content' => ucwords($data['content']),
            'category_id' => (int)$data['category'] ?? null,
            'thumbnail' => $thumbnailName,
            'bg_image' => $backgroundName,
            'user_id' => $user->id
        ]);
    }

    /**
     * Update a post.
     *
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function updatePost(Post $post, array $data): Post
    {
        $directory = str_replace(' ', '_', $data['title']);

        $thumbnailName = $data['thumbnail'] ?? $this->storeFile($data, 'thumbnails');

        $backgroundName = $data['bg_image'] ?? $this->storeFile($data, 'bg_images');

        File::delete(public_path('images/thumbnails/'.$directory) .'/'. $post->thumbnail);
        File::delete(public_path('images/bg_images/'.$directory) .'/'. $post->bg_image);

        $post->update([
            'title' => ucwords($data['title']),
            'content' => ucwords($data['content']),
            'category_id' => (int)$data['category'] ?? null,
            'thumbnail' => $thumbnailName,
            'bg_image' => $backgroundName
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

    /**
     * Return the path to the file being stored.
     *
     * @param array $data
     * @param string $subfolder
     * @return string
     */
    private function storeFile(array $data, string $subfolder): string
    {
        $directory = str_replace(' ', '_', $data['title']);

        $extension = $data['thumbnail']->extension();

        $fileName = time().'.'.$extension;

        $data['thumbnail']->move(public_path('images/'.$subfolder.'/'.$directory), $fileName);

        return $directory.'/'.$data['thumbnail'];
    }
}
