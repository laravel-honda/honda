<?php

namespace App\Listeners;

use App\Models\OnlineMailable;
use Illuminate\Mail\Events\MessageSending;

class CreateOnlineVersion
{
    public function handle(MessageSending $event): void
    {
        $onlineVersion = OnlineMailable::create([
            'content'    => $event->message->getBody(),
            'expires_at' => now()->addDays(30),
        ]);

        $event->data['onlineVersion'] = $onlineVersion;
    }
}
