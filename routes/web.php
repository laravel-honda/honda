<?php

use App\Http\Controllers\BlocksController;
use App\Http\Controllers\DashboardController;
use App\Providers\RouteServiceProvider;

Route::redirect('/', '/login');

Route::prefix(RouteServiceProvider::HOME)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('blocks', BlocksController::class);
});

