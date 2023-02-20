<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\userController;
use App\Http\Controllers\signinController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\fortopolioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [postController::class, 'index']);
Route::get('/dashboard/{slug}', [PostController::class, 'show'])->name('post.show');

Route::get('/user', [userController::class, 'index']);

Route::get('/fortopolio', [fortopolioController::class, 'index']);

Route::get('/signup', [signupController::class, 'index']);

Route::get('/signin', [signinController::class, 'index']);

Route::fallback(function () {return redirect('/');});