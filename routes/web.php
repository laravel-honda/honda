<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ShowManagerController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ViewOnlineMailableController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix(RouteServiceProvider::HOME)->group(function () {
    Route::get('/', ShowManagerController::class)->name('home');
    Route::resource('articles', ArticleController::class);
    Route::resource('tags', TagController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ingredients', IngredientController::class);
});

Route::redirect('/', RouteServiceProvider::HOME);
Route::redirect(RouteServiceProvider::HOME, route('articles.index'));

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('view-email-online');

require __DIR__ . '/auth.php';
