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

Route::get('/', function () {
    if(\Illuminate\Support\Facades\Auth::user() == null)
        return redirect()->route('welcome');
    else
        return redirect()->route('home');

});

Auth::routes();

Route::get('/welcome', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'index'])->name('profile');
    Route::get('/create', [\App\Http\Controllers\PostsController::class, 'create'])->name('create');
    Route::post('/create', [\App\Http\Controllers\PostsController::class, 'store'])->name('store');
    Route::get('/delete', [\App\Http\Controllers\PostsController::class, 'destroy'])->name('delete');
    Route::get('/edit/{id}', [\App\Http\Controllers\PostsController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [\App\Http\Controllers\PostsController::class, 'update'])->name('update');
    Route::post('/home', '\App\Http\Controllers\HomeController@upload');

    Route::resource('/comments', '\App\Http\Controllers\CommentsController');
    Route::get('delComment', [\App\Http\Controllers\CommentsController::class, 'destroy'])->name('delComment');

    Route::resource('/change-password', '\App\Http\Controllers\ChangePasswordController');
});
