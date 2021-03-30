<?php

namespace App\Services;

use Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\Finder\SplFileInfo;

class TranslationManager
{
    public const KEY_MISSING = 'key missing';
    public const GROUP_MISSING = 'group missing';

    public string $translationsPath;

    public function __construct(string $translationsPath = null)
    {
        $this->translationsPath = $translationsPath ?? resource_path('lang');
    }

    public function translations(): Collection
    {
        return $this->languages()->mapWithKeys(fn($language) => [$language => $this->language($language)]);
    }

    public function languages(): Collection
    {
        return collect(File::directories($this->translationsPath))
            ->map(fn(string $path) => str_replace($this->translationsPath . '/', '', $path));
    }

    public function language(string $lang = null): Collection
    {
        return ($groups = $this->languageGroups($lang))->combine(
            $groups->map(fn($group) => collect($this->translateIn($lang, $group)))
        )->sort();
    }

    public function languageGroups(string $lang = null): Collection
    {
        $lang ??= App::getLocale();
        if (!$this->hasLanguage($lang)) {
            throw new InvalidArgumentException("No translations files found in {$this->translationsPath}/{$lang}");
        }

        return Collection::fromFiles("{$this->translationsPath}/{$lang}")
            ->map(fn(SplFileInfo $file) => $file->getPathname())
            ->map(fn(string $file) => str_replace(["{$this->translationsPath}/{$lang}", '/', '.php'], ['', '.', ''], $file))
            ->map(fn(string $file) => trim($file, '.'));
    }

    public function hasLanguage(string $lang): bool
    {
        return $this->languages()->contains($lang);
    }

    /**
     * @param string $lang
     * @param string $key
     * @param array $context
     * @return array|string|null
     */
    public function translateIn(string $lang, string $key, array $context = [])
    {
        return __($key, $context, $lang);
    }

    public function outOfSync(string $lang, string $reference = null): bool
    {
        return $this->missing($lang, $reference)->isNotEmpty();
    }

    public function missing(string $lang, string $reference = null): Collection
    {
        $reference ??= config('app.locale');

        if ($lang === $reference) {
            return collect();
        }

        $missing = [
            static::GROUP_MISSING => [],
            static::KEY_MISSING => [],
        ];

        $translationsForReference = $this->language($reference);
        $translationsForLang = $this->language($lang);

        $translationsForReference
            ->diffKeys($translationsForLang)
            ->keys()
            ->each(function ($group) use (&$missing) {
                $missing[static::GROUP_MISSING][] = $group;
            });

        collect(TranslationKeysFlattener::flatten($translationsForReference))
            ->diffKeys(TranslationKeysFlattener::flatten($translationsForLang))
            ->filter(fn($_, $key) => !in_array(explode('.', $key)[0], $missing[static::GROUP_MISSING]))
            ->each(function ($_, $key) use (&$missing) {
                $missing[static::KEY_MISSING][] = $key;
            });

        return collect($missing);
    }

    public function findProposalFor(string $key, string $in, string $from = null): string
    {
        $translator = new GoogleTranslate($in, $from);
        $cacheKey = "google-translate.{$in}-{$from}.{$key}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $translated = $translator->translate(
            preg_replace('/:([a-zA-Z]+)/', '__@$1.com', $this->translateIn($from, $key))
        );

        $translated = preg_replace('/__@([a-zA-Z]+).com/', ':$1', $translated);

        Cache::put($cacheKey, $translated);

        return $translated;
    }
}
