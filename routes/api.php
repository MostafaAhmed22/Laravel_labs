<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/posts',PostController::class)->middleware('auth:sanctum')->except(['index']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);