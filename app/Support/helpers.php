<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\Valuestore\Valuestore;

if (!function_exists('settings')) {
    /**
     * @return Valuestore|mixed
     */
    function settings(string $key = null)
    {
        if ($key) {
            return app('settings')->get($key);
        }

        return app('settings');
    }
}

if (!function_exists('flash')) {
    function flash(string $message, string $level = 'success'): void
    {
        session()->flash($level, $message);
    }
}

if (!function_exists('user')) {
    function user(): ?Authenticatable
    {
        return auth()->user();
    }
}
