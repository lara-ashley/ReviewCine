<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmmakerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $movies = \App\Models\Movie::all(); // buscar todos os filmes
    return view('dashboard', compact('movies')); // envia $movies para a view
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    require __DIR__.'/admin.php';
});

Route::resource('actors', ActorController::class)->only(['index', 'show']);

Route::resource('genres', GenreController::class)->only(['index', 'show']);

Route::resource('filmmakers', FilmmakerController::class)->only(['index', 'show']);

Route::get('movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('movies/{movie}/comments', [CommentController::class, 'index'])
    ->name('movies.comments.index');
Route::post('movies/{movie}/comments', [CommentController::class, 'store'])
    ->name('movies.comments.store');
Route::get('movies/{movie}/comments/create', [CommentController::class, 'create'])
    ->name('movies.comments.create');
Route::get('comments/{comment}', [CommentController::class, 'show'])
    ->name('comments.show');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');
Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])
->name('comments.edit');
Route::put('comments/{comment}', [CommentController::class, 'update'])
->name('comments.update');


// --------------------------------------
// PERFIL
// --------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); 
})->name('logout');