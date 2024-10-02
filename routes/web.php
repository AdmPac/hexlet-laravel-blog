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
Route::get('/create', [Controllers\LoginController::class, 'create'])->name('login.create');
 
Route::post('/create', [Controllers\LoginController::class, 'store'])->name('login.store');
