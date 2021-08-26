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

Auth::routes();

Route::get('/')
    ->uses('PostController@index')
    ->name('posts.index');

Route::get('/posts/{post}')
    ->uses('PostController@show')
    ->name('posts.show');

Route::middleware('auth')
    ->prefix('panel')
    ->group(function () {
        Route::get('/posts')
            ->uses('Panel\PostController@index')
            ->name('panel.posts.index');

        Route::put('/posts/disable/{post}')
            ->uses('Panel\PostController@disable')
            ->name('panel.posts.disable');

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

        Route::put('/posts/{post}/edit')
            ->uses('Panel\PostController@update')
            ->name('panel.posts.update');

        Route::prefix('admin')
            ->middleware('role:' . Role::ADMIN)
            ->group(function () {
                Route::get('/posts/')
                    ->uses('Admin\PostController@index')
                    ->name('panel.admin.posts.index');

                Route::post('/posts/disable/{post}')
                    ->uses('Admin\PostController@disable')
                    ->name('panel.admin.posts.disable');

                Route::post('/posts/enable/{post}')
                    ->uses('Admin\PostController@enable')
                    ->name('panel.admin.posts.enable');

                Route::get('/posts/{post}')
                    ->uses('Admin\PostController@show')
                    ->name('panel.admin.posts.show');


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

                Route::put('/categories/{category}/edit')
                    ->uses('Admin\CategoryController@update')
                    ->name('panel.admin.categories.update');

                Route::post('/categories/{category}/disable')
                    ->uses('Admin\CategoryController@disable')
                    ->name('panel.admin.categories.disable');

                Route::post('/categories/{category}/enable')
                    ->uses('Admin\CategoryController@enable')
                    ->name('panel.admin.categories.enable');


                Route::get('/users/')
                    ->uses('Admin\UserController@index')
                    ->name('panel.admin.users.index');

                Route::get('/users/create')
                    ->uses('Admin\UserController@create')
                    ->name('panel.admin.users.create');

                Route::post('/users/create')
                    ->uses('Admin\UserController@store')
                    ->name('panel.admin.users.store');

                Route::post('/users/{user}/disable')
                    ->uses('Admin\UserController@disable')
                    ->name('panel.admin.users.disable');

                Route::post('/users/{user}/enable')
                    ->uses('Admin\UserController@enable')
                    ->name('panel.admin.users.enable');

                Route::post('/users/{user}/promote')
                    ->uses('Admin\UserController@promote')
                    ->name('panel.admin.users.promote');

                //todo - hard delete a category
            });
        });
