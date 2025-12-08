<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmmakerController;
use App\Http\Controllers\CommentController;

// ------------------------------
// MOVIES (ADMIN)
// ------------------------------
Route::get('movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

// ------------------------------
// ACTORS (ADMIN)
// ------------------------------
Route::get('actors/create', [ActorController::class, 'create'])->name('actors.create');
Route::post('actors', [ActorController::class, 'store'])->name('actors.store');
Route::get('actors/{actor}/edit', [ActorController::class, 'edit'])->name('actors.edit');
Route::put('actors/{actor}', [ActorController::class, 'update'])->name('actors.update');
Route::delete('actors/{actor}', [ActorController::class, 'destroy'])->name('actors.destroy');

// ------------------------------
// GENRES (ADMIN)
// ------------------------------
Route::get('genres/create', [GenreController::class, 'create'])->name('genres.create');
Route::post('genres', [GenreController::class, 'store'])->name('genres.store');
Route::get('genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
Route::put('genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
Route::delete('genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');

// ------------------------------
// FILMMAKERS (ADMIN)
// ------------------------------
Route::get('filmmakers/create', [FilmmakerController::class, 'create'])->name('filmmakers.create');
Route::post('filmmakers', [FilmmakerController::class, 'store'])->name('filmmakers.store');
Route::get('filmmakers/{filmmaker}/edit', [FilmmakerController::class, 'edit'])->name('filmmakers.edit');
Route::put('filmmakers/{filmmaker}', [FilmmakerController::class, 'update'])->name('filmmakers.update');
Route::delete('filmmakers/{filmmaker}', [FilmmakerController::class, 'destroy'])->name('filmmakers.destroy');

// ------------------------------
// COMMENTS (ADMIN)
// ------------------------------
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
