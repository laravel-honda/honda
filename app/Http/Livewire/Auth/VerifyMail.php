<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class VerifyMail extends Component
{
    public function render(): View
    {
        return view('livewire.auth.verify-mail');
    }

    public function checkForVerification(array $formData)
    {
        $user             = \request()->user();
        $verificationCode = $formData['verification_code'];
        $valid            = $user->email_verification_code === (int) $verificationCode;

        if (!$valid) {
            throw ValidationException::withMessages(['verification_code' => 'Invalid code']);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }

    public function sendVerificationMail(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back();
    }
}
