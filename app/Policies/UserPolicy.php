<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function createUser(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

    public function accessUser(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

    public function accessPost(User $user, Post $post): bool
    {
        return $user->role === Role::ADMIN || $user->id === $post->userId();
    }

    public function createPost(User $user): bool
    {
        return $user->role === Role::USER;
    }

    public function disablePost(User $user, Post $post): bool
    {
        return $user->role === Role::ADMIN || $user->id === $post->userId();
    }

    public function enablePost(User $user, Post $post): bool
    {
        return $user->role === Role::ADMIN || $user->id === $post->userId();
    }

    public function deletePost(User $user, Post $post): bool
    {
        return $user->id === $post->userId();
    }
}
