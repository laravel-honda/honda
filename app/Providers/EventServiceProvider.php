<?php

namespace App\Providers;

use App\Listeners\AppendUrlToMailable;
use App\Listeners\CreateOnlineVersion;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSending;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MessageSending::class => [
            CreateOnlineVersion::class,
            AppendUrlToMailable::class,
        ],
    ];

    public function boot(): void
    {
    }
}
