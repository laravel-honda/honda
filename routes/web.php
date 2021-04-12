<?php

use App\Http\Controllers\ShowManagerController;
use App\Http\Controllers\ViewOnlineMailableController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;


Route::redirect('/', RouteServiceProvider::HOME);

Route::middleware(['auth', 'verified'])->prefix(RouteServiceProvider::HOME)->group(function () {
    Route::get('/', ShowManagerController::class)->name('home');
});

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('view-email-online');

require __DIR__ . '/auth.php';
