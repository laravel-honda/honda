<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyMail extends Notification
{
    private int $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail(User $user)
    {
        return (new MailMessage())
            ->subject(sprintf('[%s] Please verify your email address', config('app.name')))
            ->greeting(sprintf('Almost done, %s', $user->name))
            ->line(sprintf('To complete your %s sign up, we just need to verify your email address: %s.', config('app.name'), $user->getEmailForVerification()))
            ->line('Please enter the code below : ')
            ->line('')
            ->line($this->code)
            ->line('')
            ->line(sprintf('You’re receiving this email because you recently created a new %s account or added a new email address. If this wasn’t you, please ignore this email.', config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
