<?php

use App\Http\Controllers\Controller;
use app\Http\Middleware\CheckUserExists;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\userDetailsController;
use App\Http\Controllers\depositController;
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


Route::get('/dashboard', [postController::class, 'index'])->name('dashboard');
Route::get('/dashboard/{slug}', [PostController::class, 'show'])->name('post.show')->middleware('auth', 'UserDetileIsFilled');

Route::get('/register', [userDetailsController::class, 'create'])->middleware('auth')->name('register');
Route::post('/register', [userDetailsController::class, 'store'])->middleware('auth')->name('register.store');
Route::put('/register/edit', [userDetailsController::class, 'update'])->middleware('auth')->name('register.update');
Route::get('/register/edit', [userDetailsController::class, 'edit'])->middleware('auth')->name('editData');
Route::post('/register/edit', [userDetailsController::class, 'update'])->middleware('auth')->name('updateData');

Route::get('/user', [userController::class, 'index'])->middleware('auth', 'UserDetileIsFilled');
Route::get('/user/create', [userController::class, 'create'])->middleware('auth', 'UserDetileIsFilled');
Route::post('/user', [userController::class, 'store'])->middleware('auth', 'UserDetileIsFilled');
Route::get('/user/{slug}', [userController::class, 'show'])->middleware('auth', 'UserDetileIsFilled');
Route::get('/user/apply/{slug}', [userApplyController::class, 'index'])->middleware('auth', 'UserDetileIsFilled');
Route::post('/user/{slug}/store', [userApplyController::class, 'userapplystore'])->middleware('auth', 'UserDetileIsFilled');

Route::get('/apply', [applyController::class, 'index'])->middleware('auth', 'UserDetileIsFilled');
Route::get('/apply/{slug}', [applyController::class, 'create'])->middleware('auth', 'UserDetileIsFilled');
Route::post('/apply/{slug}', [applyController::class, 'store'])->name('apply.store')->middleware('auth', 'UserDetileIsFilled');

Route::get('/fortopolio', [fortopolioController::class, 'index']);

Route::get('/signup', [signupController::class, 'index'])->middleware('guest');
Route::post('/signup', [signupController::class, 'store'])->middleware('guest');

Route::get('/signin', [signinController::class, 'index'])->name('login')->middleware('guest');
Route::post('/signin', [signinController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [signinController::class, 'logout']);

Route::post('/comments', [commentController::class, 'storeComment'])
->middleware('App\Http\Middleware\BlockDirectAccess');
Route::post('/comments/reply', [commentController::class, 'storeReply'])
->middleware('App\Http\Middleware\BlockDirectAccess');

Route::get('/deposit/{username}', [depositController::class, 'index'])->middleware('auth', 'UserDetileIsFilled');

Route::get('/{user}', [usagerController::class, 'showProfile'])->name('user.profile');
// Route::get('/{user}', [usagerController::class, 'showProfile'])->name('user.profile')->middleware('CheckUserExists');
// Route::get('/user-not-found', function () {return 'User not found';})->name('user.notfound');

Route::fallback(function () {return redirect('/');});