<?php

use App\Http\Controllers\ViewOnlineMailableController;
use Illuminate\Support\Facades\Route;

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('view-email-online');

require __DIR__ . '/auth.php';
