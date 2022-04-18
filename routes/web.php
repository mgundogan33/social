<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\question\indexController;

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
    Route::get('/', [indexController::class, 'index'])->name('index');

    Route::group(['namespace' => 'question', 'as' => 'question.', 'prefix' => 'question'], function () {
        Route::get('/create', [indexController::class, 'create'])->name('create');
    });
});
