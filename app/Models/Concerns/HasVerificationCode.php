<?php

namespace App\Models\Concerns;

trait HasVerificationCode
{
    public function sendEmailVerificationNotification()
    {
        $code = $this->email_verification_code;

        if ($code === null) {
            $this->update([
                'email_verification_code' => $code = $this->generateSecretCode(6),
            ]);
        }

        $this->notify(new VerifyMail($code));
    }

    private function generateSecretCode(int $length): int
    {
        $code = '';

        for (; $length > 0; $length--) {
            $code .= (string) random_int(1, 9);
        }

        return (int) $code;
    }

    public function checkEmailVerificationCode(int $code): bool
    {
        return $this->email_verification_code === $code;
    }
}
