<?php

namespace App\Console\Commands\Make;

use File;
use Illuminate\Console\Command;

class ViewMakeCommand extends Command
{
    /** @var string */
    protected $signature = 'make:view {name}';

    /** @var string */
    protected $description = 'Creates a view programmatically';

    public function handle(): void
    {
        $name = str_replace(
            '.blade.php',
            '',
            $this->argument('name')
        );

        $path = resource_path('views/' . str_replace('.', '/', $name));

        $directories = explode(DIRECTORY_SEPARATOR, $path);
        array_pop($directories);

        if (!file_exists(implode(DIRECTORY_SEPARATOR, $directories))) {
            File::makeDirectory(implode(DIRECTORY_SEPARATOR, $directories), 0755, true);
        }

        $path .= '.blade.php';

        if (file_exists($path)) {
            $this->error('View already exists!');

            return;
        }

        $created = file_put_contents($path, $this->getViewContents());

        if (!$created) {
            $this->error('Error creating the view.');
        } else {
            $this->info('View created successfully!');
        }
    }

    public function getViewContents(): string
    {
        return <<<EOF
        <x-layout title="">
            <x-ui-container>

            </x-ui-container>
        </x-ui-layout>
        EOF;
    }
}
