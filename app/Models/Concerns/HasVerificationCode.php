<?php

namespace App\Models\Concerns;

use App\Notifications\VerifyMail;

trait HasVerificationCode
{
    public function sendEmailVerificationNotification(): void
    {
        $code = $this->email_verification_code;

        if ($code === null) {
            $this->update([
                'email_verification_code' => $code = $this->generateSecretCode(6),
            ]);
        }

        $this->notify(new VerifyMail($code));
    }

    protected function generateSecretCode(int $length): int
    {
        $code = '';

        for (; $length > 0; $length--) {
            $code .= random_int($code !== '' ? 0 : 1, 9);
        }

        return (int) $code;
    }
}
