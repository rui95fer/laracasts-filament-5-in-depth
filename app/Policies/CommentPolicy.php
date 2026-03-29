<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->is_admin || $user->is($comment->user);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->is_admin || $user->is($comment->user);
    }

    public function deleteAny(User $user): bool
    {
        return $user->is_admin;
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $user->is_admin;
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->is_admin;
    }
}
