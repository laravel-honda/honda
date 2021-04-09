<?php

namespace App\Console\Commands;

use App\Models\Translation;
use App\Services\Translation\Managers\FileManager;
use Illuminate\Console\Command;

class SyncTranslationsCommand extends Command
{
    /** @var string */
    protected $signature = 'translations:sync';

    /** @var string */
    protected $description = 'Syncs translations between files and database';

    public function handle()
    {
        $manager = new FileManager();

        $manager->removeTranslation('fr', 'some.key');

        return;

        $translations = $manager->getTranslations();

        collect(TranslationKeysFlattener::flatten($translations))->each(function ($value, string $key) {
            [$lang, $key] = explode('.', $key, 2);

            $translation = Translation::where('key', $key)->firstOr(function () use ($key, $lang, $value) {
                $translation = Translation::create([
                    'key'     => $key,
                    'entries' => [$lang => $value],
                ]);
                $this->line("Created \e[32m$key\e[0m in $lang");

                return $translation;
            });

            if ($translation->hasTranslation($lang) || $translation->getTranslation($lang) === $value) {
                return;
            }

            $translation->updateTranslation($lang, $value);
            $this->line("Created \e[32m$key\e[0m in $lang");
        });
    }
}
