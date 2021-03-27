<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class VerifyMail extends Component
{
    public function render()
    {
        return view('livewire.auth.verify-mail');
    }

    public function checkForVerification(array $formData)
    {
        $user             = \request()->user();
        $verificationCode = $formData['verification_code'];
        $valid            = $user->checkEmailVerificationCode((int) $verificationCode);

        if ($valid) {
            $user->markEmailAsVerified();
            event(new Verified($user));

            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        throw ValidationException::withMessages(['verification_code' => 'Invalid code']);
    }

    public function sendVerificationMail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back();
    }
}
