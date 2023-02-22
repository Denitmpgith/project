<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\userController;
use App\Http\Controllers\signinController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\fortopolioController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [postController::class, 'index'])->middleware('auth');
Route::get('/dashboard/{slug}', [PostController::class, 'show'])->name('post.show')->middleware('auth');

Route::get('/user', [userController::class, 'index'])->middleware('auth');
Route::get('/user/{slug}', [userController::class, 'show']);

Route::get('/fortopolio', [fortopolioController::class, 'index'])->middleware('auth');

Route::get('/signup', [signupController::class, 'index'])->middleware('guest');
Route::post('/signup', [signupController::class, 'store'])->middleware('guest');

Route::get('/signin', [signinController::class, 'index'])->name('login')->middleware('guest');
Route::post('/signin', [signinController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [signinController::class, 'logout']);

Route::fallback(function () {return redirect('/');});