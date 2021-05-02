<?php

namespace App\Models;

use App\Models\Concerns\Searchable;
use App\Notifications\VerifyMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use Searchable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'       => 'datetime',
        'email_verification_code' => 'integer',
    ];

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
            $code .= random_int(0, 9);
        }

        return (int) $code;
    }

    public function checkEmailVerificationCode(int $code): bool
    {
        return $this->email_verification_code === $code;
    }
}
