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
        $lang = $request->get('hl', $this->parseHttpLocale($request));

        if (static::ALLOWED_LANGUAGES !== ['*'] && !in_array($lang, static::ALLOWED_LANGUAGES)) {
            return $next($request);
        }

        App::setLocale($lang);

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
        })->sortByDesc(fn ($locale) => $locale['factor']);

        return explode('-', $locales->first()['locale'])[0];
    }
}
