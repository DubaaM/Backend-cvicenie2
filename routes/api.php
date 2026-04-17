<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);
        Route::put('/change-password', [AuthController::class, 'changePassword']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);
    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/notes/search', [NoteController::class, 'search']);
    Route::get('/notes-stats', [NoteController::class, 'statsByStatus']);
    Route::post('/notes/archive-old-drafts', [NoteController::class, 'archiveOldDrafts']);
    Route::get('/users/{userId}/notes-categories', [NoteController::class, 'userNotesWithCategories']);

    Route::get('/notes', [NoteController::class, 'index']);
    Route::get('/my-notes', [NoteController::class, 'myNotes']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::get('/notes/{note}', [NoteController::class, 'show']);
    Route::patch('/notes/{note}', [NoteController::class, 'update']);
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);

    Route::patch('/notes/{note}/publish', [NoteController::class, 'publish']);
    Route::patch('/notes/{note}/archive', [NoteController::class, 'archive']);
    Route::patch('/notes/{note}/pin', [NoteController::class, 'pin']);
    Route::patch('/notes/{note}/unpin', [NoteController::class, 'unpin']);

    Route::get('/notes/{note}/comments', [CommentController::class, 'noteComments']);
    Route::post('/notes/{note}/comments', [CommentController::class, 'storeNoteComment']);

    Route::get('/tasks/{task}/comments', [CommentController::class, 'taskComments']);
    Route::post('/tasks/{task}/comments', [CommentController::class, 'storeTaskComment']);

    Route::patch('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::apiResource('notes.tasks', TaskController::class)->scoped();
});



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

    Route::middleware('admin')->group(function () {
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    });
});
