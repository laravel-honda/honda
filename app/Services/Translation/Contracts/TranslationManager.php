<?php


namespace App\Services\Translation\Contracts;

use Illuminate\Support\Collection;

interface TranslationManager
{
    public const KEY_MISSING = 'key missing';
    public const GROUP_MISSING = 'group missing';

    public function getAllTranslations(): array;

    public function getTranslations(string $lang): array;

    public function getMissingTranslations(string $lang, string $reference = null): array;

    public function getLanguages(): array;

    public function getLanguageGroups(string $lang): array;

    public function hasLanguage(string $lang): bool;

    public function addTranslation(string $lang, string $key, string $value): self;

    public function removeTranslation(string $lang, string $key): self;

    public function updateTranslation(string $lang, string $key, string $value): self;

    public function translate(string $key, string $language, array $context = []): string;
}
