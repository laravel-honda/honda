<?php


namespace App\Services\Translation\Managers;


use App\Services\Translation\Contracts\TranslationManager;
use App\Services\Translation\Support\TranslationKeysFlattener;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class FileManager implements TranslationManager
{
    public string $translationsPath;

    public function __construct(string $translationsPath = null)
    {
        $this->translationsPath = $translationsPath ?? resource_path('lang');
    }

    public function getAllTranslations(): Collection
    {
        return $this->getLanguages()->mapWithKeys(fn($language) => [$language => $this->getTranslations($language)]);
    }

    public function getLanguages(): Collection
    {
        return collect(File::directories($this->translationsPath))
            ->map(fn(string $path) => str_replace($this->translationsPath . '/', '', $path));
    }

    public function getTranslations(string $lang): Collection
    {
        $groups = $this->getLanguageGroups($lang);

        return $groups->combine(
            $groups->map(fn($group) => collect($this->translate($group, $lang)))
        )->sort();
    }

    public function getLanguageGroups(string $lang): Collection
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
        return $this->getLanguages()->contains($lang);
    }

    public function translate(string $key, string $language, array $context = []): string
    {
        return __($key, $context, $language);
    }

    public function getMissingTranslations(string $lang, string $reference = null): Collection
    {
        $reference ??= config('app.locale');

        if ($lang === $reference) {
            return collect();
        }

        $missing = [
            static::GROUP_MISSING => [],
            static::KEY_MISSING => [],
        ];

        $translationsForReference = $this->getTranslations($reference);
        $translationsForLang = $this->getTranslations($lang);

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

        return collect($missing);    }

    public function addTranslation(string $lang, string $key, string $value): TranslationManager
    {
        // TODO: Implement addTranslation() method.
    }

    public function removeTranslation(string $lang, string $key): TranslationManager
    {
        // TODO: Implement removeTranslation() method.
    }

    public function updateTranslation(string $lang, string $key, string $value): TranslationManager
    {
        // TODO: Implement updateTranslation() method.
    }
}
