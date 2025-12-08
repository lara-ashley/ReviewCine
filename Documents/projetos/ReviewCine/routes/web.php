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
// --------------------------------------
// DASHBOARD
// --------------------------------------
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --------------------------------------
// ROTAS ADMIN (usando middleware pela classe diretamente)
// --------------------------------------
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    require __DIR__.'/admin.php';
});

// --------------------------------------
// ROTAS PÚBLICAS
// --------------------------------------

// ACTORS
Route::resource('actors', ActorController::class)->only(['index', 'show']);

// GENRES
Route::resource('genres', GenreController::class)->only(['index', 'show']);

// FILMMAKERS
Route::resource('filmmakers', FilmmakerController::class)->only(['index', 'show']);

// MOVIES (públicas)
Route::get('movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// COMMENTS (públicos: criar + listar)
Route::get('movies/{movie}/comments', [CommentController::class, 'index'])->name('movies.comments.index');
Route::post('movies/{movie}/comments', [CommentController::class, 'store'])->name('movies.comments.store');
Route::get('movies/{movie}/comments/create', [CommentController::class, 'create'])->name('movies.comments.create');

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
