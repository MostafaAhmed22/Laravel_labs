<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::get('/posts/show/{id}', [PostController::class, 'show']);
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->middleware('auth');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->middleware('auth');
Route::post('/posts/restore/{id}', [PostController::class, 'restore'])->middleware('auth');

Route::get('/comments/create', [CommentController::class, 'create'])->middleware('auth');
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');
Route::get('/comments/{comment}', [CommentController::class, 'show']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth');


// Socialite routes
Route::get('/auth/redirect', [SocialAuthController::class,'redirectToGithub']);
Route::get('/auth/github/callback', [SocialAuthController::class,'handleGithubCallback']);
require __DIR__.'/auth.php';
