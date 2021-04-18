<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SetLocale
{
    public const ALLOWED_LANGUAGES = ['en', 'fr'];

    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->get('hl'), static::ALLOWED_LANGUAGES)) {
            session()->put('hl', $request->get('hl'));
        }

        if (session('hl') && is_null($request->get('hl'))) {
            $request->query->set('hl', session('hl'));
        }

        if (($lang = $request->get('hl')) && (in_array($lang, static::ALLOWED_LANGUAGES) || static::ALLOWED_LANGUAGES === ['*'])) {
            App::setLocale($lang);

            return $next($request);
        }

        if (($lang = $this->parseHttpLocale($request)) && (in_array($lang, static::ALLOWED_LANGUAGES) || static::ALLOWED_LANGUAGES === ['*'])) {
            App::setLocale($lang);

            return $next($request);
        }

        return $next($request);
    }

    private function parseHttpLocale(Request $request): string
    {
        $list = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));

        $locales = Collection::make($list)->map(function ($locale) {
            $parts = explode(';', $locale);

            $mapping['locale'] = trim($parts[0]);

            if (isset($parts[1])) {
                $factorParts = explode('=', $parts[1]);

                $mapping['factor'] = $factorParts[1];
            } else {
                $mapping['factor'] = 1;
            }

            return $mapping;
        })->sortByDesc(function ($locale) {
            return $locale['factor'];
        });

        return explode('-', $locales->first()['locale'])[0];
    }
}
