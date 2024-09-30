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

// routes: articles
Route::get('articles', [Controllers\ArticlesController::class, 'articles'])->name('arc');
Route::post('articles', [Controllers\ArticlesController::class, 'store'])->name('articles.store');

Route::get('articles/create', [Controllers\ArticlesController::class, 'create'])->name('create');

Route::get('articles/{id}', [Controllers\ArticlesController::class, 'articles_id'])->name('arc_id');

Route::get('articles/{id}/edit', [Controllers\ArticlesController::class, 'edit'])->name('articles.edit');
Route::patch('articles/{id}', [Controllers\ArticlesController::class, 'update'])->name('articles.update');
Route::delete('articles/{id}', [Controllers\ArticlesController::class, 'destroy'])->name('articles.destroy');
