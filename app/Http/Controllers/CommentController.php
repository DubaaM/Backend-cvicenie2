<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function noteComments(Note $note)
    {
        $this->authorize('view', $note);

        $comments = $note->comments()
            ->with('user:id,first_name,last_name')
            ->latest()
            ->get();

        return response()->json([
            'comments' => $comments
        ], Response::HTTP_OK);
    }

    public function storeNoteComment(Request $request, Note $note)
    {
        $this->authorize('view', $note);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $comment = $note->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        return response()->json([
            'message' => 'Komentár bol úspešne pridaný.',
            'comment' => $comment->load('user:id,first_name,last_name'),
        ], Response::HTTP_CREATED);
    }

    public function taskComments(Task $task)
    {
        $this->authorize('view', $task);

        $comments = $task->comments()
            ->with('user:id,first_name,last_name')
            ->latest()
            ->get();

        return response()->json([
            'comments' => $comments
        ], Response::HTTP_OK);
    }

    public function storeTaskComment(Request $request, Task $task)
    {
        $this->authorize('view', $task);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $comment = $task->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        return response()->json([
            'message' => 'Komentár bol úspešne pridaný.',
            'comment' => $comment->load('user:id,first_name,last_name'),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $comment->update([
            'body' => $validated['body'],
        ]);

        return response()->json([
            'message' => 'Komentár bol úspešne upravený.',
            'comment' => $comment->load('user:id,first_name,last_name'),
        ], Response::HTTP_OK);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'message' => 'Komentár bol úspešne odstránený.'
        ], Response::HTTP_OK);
    }
}
