<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Post $post): bool
    {
        return $user->role === Role::ADMIN || $user->id === $post->userId();
    }

    public function create(User $user): bool
    {
        return $user->role === Role::USER;
    }

    public function disable(User $user, Post $post): bool
    {
        return $user->role === Role::ADMIN || $user->id === $post->userId();
    }

    public function enable(User $user, Post $post): bool
    {
        return $user->role === Role::ADMIN || $user->id === $post->userId();
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->userId();
    }
}
