<?php

namespace App\Policies;

use App\Models\Attachment;
use App\Models\Note;
use App\Models\User;

class AttachmentPolicy
{
    public function view(User $user, Attachment $attachment): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        $attachable = $attachment->attachable;

        if ($attachable instanceof Note) {
            if (in_array($attachable->status, ['published', 'archived'])) {
                return true;
            }

            return $attachable->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user, Note $note): bool
    {
        return $user->role === 'admin' || $note->user_id === $user->id;
    }

    public function delete(User $user, Attachment $attachment): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        $attachable = $attachment->attachable;

        if ($attachable instanceof Note) {
            return $attachable->user_id === $user->id;
        }

        return false;
    }
}
