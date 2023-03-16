<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\userController;
use App\Http\Controllers\usagerController;
use App\Http\Controllers\signinController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\applyController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\userApplyController;
use App\Http\Controllers\fortopolioController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [postController::class, 'index']);
Route::get('/dashboard/{slug}', [PostController::class, 'show'])->name('post.show')->middleware('auth');

Route::get('/user', [userController::class, 'index'])->middleware('auth');
Route::get('/user/create', [userController::class, 'create'])->middleware('auth');
Route::post('/user', [userController::class, 'store'])->middleware('auth');
Route::get('/user/{slug}', [userController::class, 'show'])->middleware('auth');
Route::get('/user/apply/{slug}', [userApplyController::class, 'index'])->middleware('auth');


Route::get('/apply', [applyController::class, 'index'])->middleware('auth');
Route::get('/apply/{slug}', [applyController::class, 'create'])->middleware('auth');
Route::post('/apply/{slug}', [applyController::class, 'store'])->name('apply.store')->middleware('auth');
// Route::post('/apply/{slug}', [applyController::class, 'storeAFile'])->name('apply.storeAFile')->middleware('auth');

Route::get('/fortopolio', [fortopolioController::class, 'index']);

Route::get('/signup', [signupController::class, 'index'])->middleware('guest');
Route::post('/signup', [signupController::class, 'store'])->middleware('guest');

Route::get('/signin', [signinController::class, 'index'])->name('login')->middleware('guest');
Route::post('/signin', [signinController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [signinController::class, 'logout']);

// Route::post('/apply/{slug}', [userController::class, 'applystore'])->name('apply.store');

Route::post('/comments', [commentController::class, 'storeComment'])
->middleware('App\Http\Middleware\BlockDirectAccess');
Route::post('/comments/reply', [commentController::class, 'storeReply'])
->middleware('App\Http\Middleware\BlockDirectAccess');





Route::get('/{user}', [usagerController::class, 'showProfile'])->name('user.profile');
Route::fallback(function () {return redirect('/');});