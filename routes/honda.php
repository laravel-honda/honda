<?php

use App\Http\Controllers\ViewOnlineMailableController;

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('honda.mails.show');

