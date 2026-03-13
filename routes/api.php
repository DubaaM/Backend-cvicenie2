<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryController;

Route::get('notes/pinned', [NoteController::class, 'pinned']);

Route::apiResource('notes', NoteController::class);
Route::apiResource('categories', CategoryController::class);
