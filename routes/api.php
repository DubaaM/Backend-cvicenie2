<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

