<?php

use App\Http\Controllers\ShowHomeController;
use App\Http\Controllers\Translations\TranslationsController;
use App\Http\Controllers\ViewOnlineMailableController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::view('/', 'front.welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->prefix(RouteServiceProvider::HOME)->group(function () {
    Route::get('/', ShowHomeController::class)->name('home');
});

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('view-email-online');

Route::prefix('_/translations')->group(function () {
    Route::get('/', [TranslationsController::class, 'index'])->name('translations.index');
    Route::get('/missing', [TranslationsController::class, 'missing'])->name('translations.missing');
});

require __DIR__ . '/auth.php';
