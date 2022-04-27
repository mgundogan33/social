<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\settings\indexController;

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

Route::group(['namespace' => 'front'], function () {
    Route::get('/', [App\Http\Controllers\front\indexController::class, 'index'])->name('index');

    Route::group(['namespace' => 'question', 'as' => 'question.', 'prefix' => 'question'], function () {
        Route::get('/create', [App\Http\Controllers\front\question\indexController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\front\question\indexController::class, 'store'])->name('store');
    });
    Route::group(['namespace' => 'comment', 'as' => 'comment.', 'prefix' => 'comment'], function () {
        Route::post('/store/{id}', [App\Http\Controllers\front\comment\indexController::class, 'store'])->name('store');
        Route::get('/like/{id}', [App\Http\Controllers\front\comment\indexController::class, 'LikeOrDiskLike'])->name('LikeOrDiskLike');
        Route::get('/delete/{id}', [App\Http\Controllers\front\comment\indexController::class, 'delete'])->name('delete');
        Route::get('/correct/{id}', [App\Http\Controllers\front\comment\indexController::class, 'correct'])->name('correct');
    });

    Route::group(['namespace' => 'category', 'as' => 'category.', 'prefix' => 'kategori'], function () {
        Route::get('/{selflink}', [App\Http\Controllers\front\category\indexController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'settings', 'as' => 'settings.', 'prefix' => 'ayarlar'], function () {
        Route::get('/', [App\Http\Controllers\front\settings\indexController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\front\settings\indexController::class, 'store'])->name('store');
        Route::get('/password', [App\Http\Controllers\front\settings\indexController::class, 'password'])->name('password');
        Route::post('/password', [App\Http\Controllers\front\settings\indexController::class, 'passwordStore'])->name('passwordStore');
    });

    Route::get('/{id}/{selflink}', [App\Http\Controllers\front\indexController::class, 'view'])->name('view')->middleware(['VisitorUser']);
});
