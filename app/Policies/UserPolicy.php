<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function promoteUser(User $user, User $userEdit): bool
    {
        return $user->isAdmin() && $userEdit->role !== Role::ADMIN;
    }

    public function enablesUser(User $user, User $userEdit): bool
    {
        if ($user->isAdmin()) {
            return $userEdit->disabled_by === $user->id;
        }

        return $user->id === $userEdit->id;
    }

    public function disableUser(User $user, User $userEdit): bool
    {
        return $user->isAdmin() && $userEdit->isUser();
    }

    public function accessPost(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    public function createPost(User $user): bool
    {
        return $user->role === Role::USER;
    }

    public function disablePost(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    public function enablePost(User $user, Post $post): bool
    {
        if ($user->isAdmin()) {
            return $post->disabled_by === $user->id;
        }

        return $user->id === $post->id;
    }

    public function deletePost(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
