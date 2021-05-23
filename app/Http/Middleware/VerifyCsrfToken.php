<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [];

    public function handle($request, Closure $next)
    {
        if (!Auth::check() && $request->route()->named('logout')) {
            $this->except[] = route('logout');
        }

        return parent::handle($request, $next);
    }
}
