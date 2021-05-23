<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController
{
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    public function store(Request $request): mixed
    {
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->get('password'),
        ])) {
            throw ValidationException::withMessages(['password' => __('auth.password')]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
