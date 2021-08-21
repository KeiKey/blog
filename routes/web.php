<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts')
    ->uses('PostController@index')
    ->name('posts.index');

Route::get('/posts/{id}')
    ->uses('PostController@index')
    ->name('posts.index');

Route::middleware('auth')
    ->prefix('panel')
    ->group(function () {
        Route::get('/posts/')
            ->uses('Panel\PostController@index')
            ->name('posts.index');

        Route::get('/posts/{post}')
            ->uses('Panel\PostController@show')
            ->name('posts.show');

        Route::delete('/posts/{post}')
            ->uses('Panel\PostController@destroy')
            ->name('posts.destroy');

        Route::get('/posts/{post}/edit')
            ->uses('Panel\PostController@edit')
            ->name('posts.edit');

        Route::post('/posts/{post}/edit')
            ->uses('Panel\PostController@update')
            ->name('posts.update');

        Route::get('/posts/create')
            ->uses('Panel\PostController@create')
            ->name('posts.create');

        Route::post('/posts/create')
            ->uses('Panel\PostController@store')
            ->name('posts.store');

        //todo- middleware with the role admin
        Route::prefix('admin')->group(function () {
            Route::get('/posts/')
                ->uses('Admin\PostController@index')
                ->name('posts.index');

            Route::get('/posts/{post}')
                ->uses('Admin\PostController@show')
                ->name('posts.show');

            Route::delete('/posts/{post}')
                ->uses('Admin\PostController@destroy')
                ->name('posts.destroy');

            Route::get('/posts/{post}/edit')
                ->uses('Admin\PostController@edit')
                ->name('posts.edit');

            Route::post('/posts/{post}/edit')
                ->uses('Admin\PostController@update')
                ->name('posts.update');

            Route::get('/posts/create')
                ->uses('Admin\PostController@create')
                ->name('posts.create');

            Route::post('/posts/')
                ->uses('Admin\PostController@store')
                ->name('posts.store');
        });
    });
