<?php

use App\Models\User;
use Spatie\Valuestore\Valuestore;

if (!function_exists('settings')) {
    function settings(string $key = null): Valuestore | string | array
    {
        if ($key) {
            return app('settings')->get($key);
        }

        return app('settings');
    }
}

if (!function_exists('any')) {
    function any(iterable $values, callable $truthTest): bool
    {
        foreach ($values as $key => $value) {
            if ($truthTest($value, $key)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('every')) {
    function every(iterable $values, callable $truthTest): bool
    {
        foreach ($values as $key => $value) {
            if (!$truthTest($value, $key)) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('user')) {
    function user(): User
    {
        $user = Auth::user();

        abort_if($user === null, 403);

        return $user;
    }
}
