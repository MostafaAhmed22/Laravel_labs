<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [PostController::class, 'home']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/show/{post_id}', [PostController::class, 'show']);
