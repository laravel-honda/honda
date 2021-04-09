<?php

namespace App\Services\Translation\Managers;

use App\Services\Translation\Contracts\TranslationManager;

class DatabaseManager implements TranslationManager
{
    public function getAllTranslations(): array
    {
        // TODO: Implement getAllTranslations() method
        return [];
    }

    public function getTranslations(string $lang): array
    {
        // TODO: Implement getTranslations() method.
        return [];
    }

    public function getMissingTranslations(string $lang, string $reference = null): array
    {
        // TODO: Implement getMissingTranslations() method.
        return [];
    }

    public function getLanguages(): array
    {
        // TODO: Implement getLanguages() method.
        return [];
    }

    public function getLanguageGroups(string $lang): array
    {
        // TODO: Implement getLanguageGroups() method.
        return [];
    }

    public function hasLanguage(string $lang): bool
    {
        // TODO: Implement hasLanguage() method.
        return false;
    }

    public function addTranslation(string $lang, string $key, string $value): TranslationManager
    {
        // TODO: Implement addTranslation() method.
        return $this;
    }

    public function removeTranslation(string $lang, string $key): TranslationManager
    {
        // TODO: Implement removeTranslation() method.
        return $this;
    }

    public function updateTranslation(string $lang, string $key, string $value): TranslationManager
    {
        // TODO: Implement updateTranslation() method.
        return $this;
    }

    public function translate(string $key, string $language, array $context = []): string
    {
        // TODO: Implement translate() method.
        return '';
    }
}
