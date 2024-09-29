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

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', [Controllers\PageController::class, 'about']);

Route::get('articles', [Controllers\ArticlesController::class, 'articles'])->name('arc');
Route::get('articles/{id}', [Controllers\ArticlesController::class, 'articles_id'])->name('arc_id');
