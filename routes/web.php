<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
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


Route::controller(Controllers\LoginController::class)->group(function () {
    Route::get('/create', 'create')->name('login.create');
    Route::get('/', 'create')->name('login.create');
});

Route::post('/create', [Controllers\LoginController::class, 'store'])->name('login.store');

Route::get('/verify/{code}', [Controllers\LoginController::class, 'verify'])->name('login.verify.сode');

Route::get('/login', [Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [Controllers\LoginController::class, 'auth'])->name('login.auth');

Route::post('/logout', [Controllers\LoginController::class, 'logout'])->name('login.logout');

Route::get('/user/{id}', [Controllers\UserController::class, 'person'])->middleware('auth')->name('user.index');
Route::patch('/user/{id}', [Controllers\UserController::class, 'store'])->middleware('auth')->name('user.store');
Route::post('avatar', [Controllers\UserController::class, 'uploadAvatar'])->middleware('auth')->name('user.avatar');

Route::get('/adboard', [Controllers\AdboardController::class, 'index'])->middleware('auth')->name('adboard.index');
Route::get('/user/{id}/adboard', [Controllers\AdboardController::class, 'adboard'])->middleware('auth')->name('user.adboard');
Route::post('/user/{id}/adboard', [Controllers\AdboardController::class, 'add'])->middleware('auth')->name('user.adboard');
Route::post('/user/{id}/adboard/{adboard_id}', [Controllers\AdboardController::class, 'active'])->middleware('auth')->name('user.adboard.active');
Route::patch('/user/{id}/adboard/{adboard_id}', [Controllers\AdboardController::class, 'edit'])->middleware('auth')->name('user.adboard.edit');
Route::delete('/user/{id}/adboard/{adboard_id}', [Controllers\AdboardController::class, 'delete'])->middleware('auth')->name('user.adboard.delete');

Route::get('/test', [Controllers\TestController::class, 'index'])->name('test');
