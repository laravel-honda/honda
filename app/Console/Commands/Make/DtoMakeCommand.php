<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslationMakeCommand extends Command
{
    /** @var string */
    protected $signature = 'make:dto {name}';

    /** @var string */
    protected $description = 'Creates a data transfer object file.';

    public function handle(): void
    {
        File::ensureDirectoryExists(app_path('DataTransferObjects'));

        $name = ucfirst(strtolower($this->argument('name')));
        File::put(app_path('DataTransferObjects/' . $name . '.php'), str_replace('{}', ucfirst(strtolower($this->argument('name'))), $this->getContents()));

        $this->info('DTO successfully created.');
    }

    public function getContents(): string
    {
        return <<<EOF
        <?php

        namespace App\DataTransferObjects;

        use App\Support\DTO\DTO;

        class {} extends DTO {

        }
        EOF;
    }
}
