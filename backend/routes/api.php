<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/post', [PostController::class, 'index']);
Route::post('/post-create', [PostController::class, 'store']);
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::patch('/post/{post:slug}/edit',[PostController::class, 'update']);
Route::delete('/post/{post:slug}/delete',[PostController::class, 'destroy']);


Route::prefix('/category')->group(function(){
    Route::get('', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});


Route::post('/register',[RegisterController::class, 'register']);
Route::post('/login',[LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
