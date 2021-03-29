<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslationMakeCommand extends Command
{
    /** @var string */
    protected $signature = 'make:translation {name} {--lang=en} {--all=false}';

    /** @var string */
    protected $description = 'Creates a translation file.';

    public function handle()
    {
        if ($this->option('all')) {
            return $this->createTranslation($this->argument('name'), $this->option('lang'));
        }

        collect(File::directories(resource_path('lang')))->each(function (string $directory) {
            $this->createTranslation($this->argument('name'), str_replace(
               resource_path('lang'),
               '',
               $directory
           ));
        });
    }

    public function createTranslation(string $path, string $lang)
    {
        $name = str_replace(
            '.php',
            '',
            $path
        );

        $path = resource_path("lang$lang/");

        if (str_contains($name, '.') || str_contains($name, '/')) {
            $name = str_replace('.', '/', $name);

            $parts = explode('/', $name);
            $name  = array_pop($parts);
            $path .= implode('/', $parts) . '/';
        }

        $directories = explode(DIRECTORY_SEPARATOR, $path);

        if (!file_exists(implode(DIRECTORY_SEPARATOR, $directories))) {
            File::makeDirectory(implode(DIRECTORY_SEPARATOR, $directories), 0755, true);
        }

        $path .= str_replace('.', '/', $name) . '.php';
        $strippedPath = str_replace(resource_path('lang'), '', $path);
        if (file_exists($path)) {
            $this->warn("$strippedPath already exists.");

            return;
        }

        $created = file_put_contents($path, $this->getTranslationContents());

        if (!$created) {
            $this->warn("Could not create $strippedPath.");
        } else {
            $this->info("Created $strippedPath.");
        }
    }

    public function getTranslationContents(): string
    {
        return <<<EOF
        <?php

        return [

        ];
        EOF;
    }
}
