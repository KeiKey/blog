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

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('{static}', [App\Http\Controllers\SiteController::class, 'index'])->name('static.page');
Route::post('subscribe', [App\Http\Controllers\SiteController::class, 'subscribe'])->name('subscribe');
Route::post('contact', [App\Http\Controllers\SiteController::class, 'contact'])->name('contact');

Route::middleware('auth')
    ->prefix('panel')
    ->group(function () {
        Route::resource('posts', 'Panel\PostController', ['as' => 'panel']);
        Route::put('posts/disable/{post}', [App\Http\Controllers\Panel\PostController::class, 'disable'])->name('panel.posts.disable');

        Route::prefix('admin')
            ->middleware('role:' . Role::ADMIN)
            ->group(function () {
                Route::resource('posts', 'Admin\PostController', ['as' => 'panel.admin'])->only(['index', 'show']);
                Route::post('posts/disable/{post}', [App\Http\Controllers\Admin\PostController::class, 'disable'])->name('panel.admin.posts.disable');
                Route::post('posts/enable/{post}', [App\Http\Controllers\Admin\PostController::class, 'enable'])->name('panel.admin.posts.enable');

                Route::resource('categories', 'Admin\CategoryController', ['as' => 'panel.admin']);
                Route::post('categories/{category}/disable', [App\Http\Controllers\Admin\CategoryController::class, 'disable'])->name('panel.admin.categories.disable');
                Route::post('categories/{category}/enable', [App\Http\Controllers\Admin\CategoryController::class, 'enable'])->name('panel.admin.categories.enable');

                Route::resource('users', 'Admin\UserController', ['as' => 'panel.admin'])->except(['show', 'edit', 'update']);
                Route::post('users/{user}/disable', [App\Http\Controllers\Admin\UserController::class, 'disable'])->name('panel.admin.users.disable');
                Route::post('users/{user}/enable', [App\Http\Controllers\Admin\UserController::class, 'enable'])->name('panel.admin.users.enable');
                Route::post('users/{user}/promote', [App\Http\Controllers\Admin\UserController::class, 'promote'])->name('panel.admin.users.promote');

                //todo - hard delete a category
            });
        });
