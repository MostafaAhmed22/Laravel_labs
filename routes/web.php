<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [PostController::class, 'home']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/show/{post_id}', [PostController::class, 'show']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts/store', [PostController::class, 'store']);
Route::get('/posts/edit/{post_id}', [PostController::class, 'edit']);
Route::put('/posts/update/{post_id}', [PostController::class, 'update']);
Route::delete('/posts/destroy/{post_id}', [PostController::class, 'destroy']);
