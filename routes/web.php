<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;

// Home page (show all posts)
Route::get('/', function () {
    return view('home', [
        'posts' => Post::with('user')->latest()->get()
    ]);
});

// Post Routes (only for logged in users)
Route::post('/create-post', [PostController::class, 'createPost'])->middleware('auth');
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->middleware('auth');
Route::put('/update-post/{post}', [PostController::class, 'actuallyUpdatePost'])->middleware('auth');
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->middleware('auth');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Auth Routes
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
