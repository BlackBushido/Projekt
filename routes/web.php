<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\User;
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

Route::get('/',[\App\Http\Controllers\HomeController::class ,'index']);

Auth::routes();

Route::resource('/comments', '\App\Http\Controllers\CommentsController');
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'index'])->name('profile');
    Route::get('/create', [\App\Http\Controllers\PostsController::class, 'create'])->name('create');
    Route::post('/create', [\App\Http\Controllers\PostsController::class, 'store'])->name('store');
    Route::get('/delete', [\App\Http\Controllers\PostsController::class, 'destroy'])->name('delete');
    Route::get('/edit/{id}', [\App\Http\Controllers\PostsController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [\App\Http\Controllers\PostsController::class, 'update'])->name('update');
    Route::post('/home', '\App\Http\Controllers\HomeController@upload');

    Route::get('delComment', [\App\Http\Controllers\CommentsController::class, 'destroy'])->name('delComment');

    Route::resource('/change-password', '\App\Http\Controllers\ChangePasswordController');
});

Route::get('/searchPosts', '\App\Http\Controllers\PostsController@search')->name('searchPosts');
Route::get('/searchComments/{id}', '\App\Http\Controllers\CommentsController@search')->name('searchComments');
