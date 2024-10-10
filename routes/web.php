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


Route::resource('/articles', Controllers\ArticleController::class);

Route::controller(Controllers\LoginController::class)->group(function () {
    Route::get('/create', 'create')->name('login.create');
    Route::get('/', 'create')->name('login.create');
});

Route::post('/create', [Controllers\LoginController::class, 'store'])->name('login.store');

Route::get('/login', [Controllers\LoginController::class, 'login'])->name('login.login');
Route::post('/login', [Controllers\LoginController::class, 'auth'])->name('login.auth');

Route::get('/user/{id}', [Controllers\LoginController::class, 'index'])->name('user.index');
