<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Note;
use App\Models\Task;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        $commentable = $comment->commentable;

        if ($commentable instanceof Note) {
            if (in_array($commentable->status, ['published', 'archived'])) {
                return true;
            }

            return $commentable->user_id === $user->id;
        }

        if ($commentable instanceof Task) {
            return $commentable->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->role === 'admin' || $comment->user_id === $user->id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->role === 'admin' || $comment->user_id === $user->id;
    }
}
