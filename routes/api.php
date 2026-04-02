<?php

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
    });
});
Route::middleware('auth:sanctum')->group(function () {
    // všetci prihlásení môžu čítať kategórie
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

    // iba admin môže vytvárať, upravovať, mazať kategórie
    Route::middleware('admin')->group(function () {
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    });
});

Route::get('/notes/search', [NoteController::class, 'search']);
Route::get('/notes', [NoteController::class, 'index']);
Route::post('/notes', [NoteController::class, 'store']);
Route::get('/notes/{id}', [NoteController::class, 'show']);
Route::put('/notes/{id}', [NoteController::class, 'update']);
Route::delete('/notes/{id}', [NoteController::class, 'destroy']);

Route::get('/notes-stats', [NoteController::class, 'statsByStatus']);
Route::post('/notes/archive-old-drafts', [NoteController::class, 'archiveOldDrafts']);
Route::get('/users/{userId}/notes-categories', [NoteController::class, 'userNotesWithCategories']);
Route::post('/notes/{id}/publish', [NoteController::class, 'publish']);

Route::patch('/notes/{id}/pin', [NoteController::class, 'pin']);
Route::patch('/notes/{id}/unpin', [NoteController::class, 'unpin']);
Route::patch('/notes/{id}/publish', [NoteController::class, 'publish']);
Route::patch('/notes/{id}/archive', [NoteController::class, 'archive']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::apiResource('notes.tasks', TaskController::class)->scoped();



