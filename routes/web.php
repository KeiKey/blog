<?php

use App\Enums\Role;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts')
    ->uses('PostController@index')
    ->name('posts.index');

Route::get('/posts/{post}')
    ->uses('PostController@show')
    ->name('posts.show');

Route::middleware('auth')
    ->prefix('panel')
    ->group(function () {
        Route::get('/posts/')
            ->uses('Panel\PostController@index')
            ->name('panel.posts.index');

        Route::get('/posts/create')
            ->uses('Panel\PostController@create')
            ->name('panel.posts.create');

        Route::post('/posts/create')
            ->uses('Panel\PostController@store')
            ->name('panel.posts.store');

        Route::get('/posts/{post}')
            ->uses('Panel\PostController@show')
            ->name('panel.posts.show');

        Route::delete('/posts/{post}')
            ->uses('Panel\PostController@destroy')
            ->name('panel.posts.destroy');

        Route::get('/posts/{post}/edit')
            ->uses('Panel\PostController@edit')
            ->name('panel.posts.edit');

        Route::post('/posts/{post}/edit')
            ->uses('Panel\PostController@update')
            ->name('panel.posts.update');

        //todo- middleware with the role admin
        Route::prefix('admin')
            ->middleware('role:' . Role::ADMIN)
            ->group(function () {
                Route::get('/posts/')
                    ->uses('Admin\PostController@index')
                    ->name('panel.admin.posts.index');

                Route::get('/posts/create')
                    ->uses('Admin\PostController@create')
                    ->name('panel.admin.posts.create');

                Route::post('/posts/create')
                    ->uses('Admin\PostController@store')
                    ->name('panel.admin.posts.store');

                Route::get('/posts/{post}')
                    ->uses('Admin\PostController@show')
                    ->name('panel.admin.posts.show');

                Route::delete('/posts/{post}')
                    ->uses('Admin\PostController@destroy')
                    ->name('panel.admin.posts.destroy');

                Route::get('/posts/{post}/edit')
                    ->uses('Admin\PostController@edit')
                    ->name('panel.admin.posts.edit');

                Route::post('/posts/{post}/edit')
                    ->uses('Admin\PostController@update')
                    ->name('panel.admin.posts.update');


                Route::get('/categories/')
                    ->uses('Admin\CategoryController@index')
                    ->name('panel.admin.categories.index');

                Route::get('/categories/create')
                    ->uses('Admin\CategoryController@create')
                    ->name('panel.admin.categories.create');

                Route::post('/categories/create')
                    ->uses('Admin\CategoryController@store')
                    ->name('panel.admin.categories.store');

                Route::delete('/categories/{category}')
                    ->uses('Admin\CategoryController@destroy')
                    ->name('panel.admin.categories.destroy');

                Route::get('/categories/{category}/edit')
                    ->uses('Admin\CategoryController@edit')
                    ->name('panel.admin.categories.edit');

                Route::post('/categories/{category}/edit')
                    ->uses('Admin\CategoryController@update')
                    ->name('panel.admin.categories.update');


                Route::get('/users/')
                    ->uses('Admin\UserController@index')
                    ->name('panel.admin.users.index');

                Route::get('/users/create')
                    ->uses('Admin\UserController@create')
                    ->name('panel.admin.users.create');

                Route::post('/users/create')
                    ->uses('Admin\UserController@store')
                    ->name('panel.admin.users.store');

                Route::delete('/users/{user}')
                    ->uses('Admin\UserController@destroy')
                    ->name('panel.admin.users.destroy');

                Route::get('/users/{user}/edit')
                    ->uses('Admin\UserController@edit')
                    ->name('panel.admin.users.edit');

                Route::post('/users/{user}/edit')
                    ->uses('Admin\UserController@update')
                    ->name('panel.admin.users.update');

                //todo - hard delete a category
            });
        });
