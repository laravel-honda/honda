<?php

use App\Http\Controllers\ViewOnlineMailableController;

Route::get('/_/mail/view/{onlineMailable}', ViewOnlineMailableController::class)->name('honda.mails.show');

if (app()->bound('sitemap')) {
    Route::get('/sitemap.xml', function () {
        return app('sitemap');
    });
}
