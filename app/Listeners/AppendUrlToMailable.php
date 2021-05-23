<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;

class AppendUrlToMailable
{
    public function handle(MessageSending $event): void
    {
        $event->message->setBody(
            preg_replace('/(<body .+>)/', '$1' . $this->getBanner($event), $event->message->getBody())
        );
    }

    public function getBanner(MessageSending $event): string
    {
        $url = $event->data['onlineVersion']->getSignedUrl();

        return <<<HTML
<div style="width: 100%;background-color:#ffffff;padding: 8px 0;">
    <p style="font-size: 12px;color:#4a5568;text-align:center;line-height: 6px;font-family:sans-serif;">Can't see this email properly? <a style="color:#4c51bf;" href="$url"> View it in the browser</a>.</p>
</div>
HTML;
    }
}
