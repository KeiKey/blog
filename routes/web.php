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
        Route::get('posts', [App\Http\Controllers\Panel\PostController::class, 'index'])
            ->name('panel.posts.index');

        Route::put('posts/disable/{post}', [App\Http\Controllers\Panel\PostController::class, 'disable'])
            ->name('panel.posts.disable');

        Route::get('posts/create', [App\Http\Controllers\Panel\PostController::class, 'create'])
            ->name('panel.posts.create');

        Route::post('posts/create', [App\Http\Controllers\Panel\PostController::class, 'store'])
            ->name('panel.posts.store');

        Route::get('posts/{post}', [App\Http\Controllers\Panel\PostController::class, 'show'])
            ->name('panel.posts.show');

        Route::delete('posts/{post}', [App\Http\Controllers\Panel\PostController::class, 'destroy'])
            ->name('panel.posts.destroy');

        Route::get('posts/{post}/edit', [App\Http\Controllers\Panel\PostController::class, 'edit'])
            ->name('panel.posts.edit');

        Route::put('posts/{post}/edit', [App\Http\Controllers\Panel\PostController::class, 'update'])
            ->name('panel.posts.update');

        Route::prefix('admin')
            ->middleware('role:' . Role::ADMIN)
            ->group(function () {
                Route::get('posts/', [App\Http\Controllers\Admin\PostController::class, 'index'])
                    ->name('panel.admin.posts.index');

                Route::post('posts/disable/{post}', [App\Http\Controllers\Admin\PostController::class, 'disable'])
                    ->name('panel.admin.posts.disable');

                Route::post('posts/enable/{post}', [App\Http\Controllers\Admin\PostController::class, 'enable'])
                    ->name('panel.admin.posts.enable');

                Route::get('posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'show'])
                    ->name('panel.admin.posts.show');


                Route::get('categories/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])
                    ->name('panel.admin.categories.index');

                Route::get('categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])
                    ->name('panel.admin.categories.create');

                Route::post('categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'store'])
                    ->name('panel.admin.categories.store');

                Route::delete('categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])
                    ->name('panel.admin.categories.destroy');

                Route::get('categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])
                    ->name('panel.admin.categories.edit');

                Route::put('categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'update'])
                    ->name('panel.admin.categories.update');

                Route::post('categories/{category}/disable', [App\Http\Controllers\Admin\CategoryController::class, 'disable'])
                    ->name('panel.admin.categories.disable');

                Route::post('categories/{category}/enable', [App\Http\Controllers\Admin\CategoryController::class, 'enable'])
                    ->name('panel.admin.categories.enable');


                Route::get('users/', [App\Http\Controllers\Admin\UserController::class, 'index'])
                    ->name('panel.admin.users.index');

                Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])
                    ->name('panel.admin.users.create');

                Route::post('users/create', [App\Http\Controllers\Admin\UserController::class, 'store'])
                    ->name('panel.admin.users.store');

                Route::post('users/{user}/disable', [App\Http\Controllers\Admin\UserController::class, 'disable'])
                    ->name('panel.admin.users.disable');

                Route::post('users/{user}/enable', [App\Http\Controllers\Admin\UserController::class, 'enable'])
                    ->name('panel.admin.users.enable');

                Route::post('users/{user}/promote', [App\Http\Controllers\Admin\UserController::class, 'promote'])
                    ->name('panel.admin.users.promote');

                //todo - hard delete a category
            });
        });
