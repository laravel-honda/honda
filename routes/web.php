<?php

use App\Http\Controllers\ShowHomeController;
use App\Http\Controllers\ViewOnlineMailableController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

Route::view('/', 'front.welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->prefix(RouteServiceProvider::HOME)->group(function () {
    Route::get('/', ShowHomeController::class)->name('home');
});

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('view-email-online');


require __DIR__ . '/auth.php';
