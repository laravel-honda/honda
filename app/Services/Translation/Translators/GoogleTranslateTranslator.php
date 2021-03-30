<?php


namespace App\Services\Translation\Translators;


use App\Services\Translation\Contracts\Translator;
use Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslateTranslator implements Translator
{
    public function translate(string $text, string $from, string $to, bool $cache = true): string
    {
        $translator = new GoogleTranslate($from, $from);
        $cacheKey = $this->cacheKey($from, $to, $text);

        if ($cache && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // We hide any attribute from Google by transforming :this to https://this.com which should never be
        // translated by Google Translate based on my tests and various internet readings.
        $text = preg_replace('/:([a-zA-Z1-9]+)/', 'https://$1.com', $text);
        $translated = $translator->translate($text);

        // We transform back all the attribute previously hidden (https://{attribute}.com to :attribute)
        $translated = preg_replace('/https:\/\/([a-zA-Z1-9]+).com/', ':$1', $translated);

        Cache::put($cacheKey, $translated);

        return $translated;
    }

    public function cacheKey(string $from, string $to, string $text): string
    {
        return "{$this->cachePrefix}.{$from}-{$to}." . base64_encode($text);
    }
}
