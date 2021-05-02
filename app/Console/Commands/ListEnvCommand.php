<?php

namespace App\Console\Commands;

use App;
use Dotenv\Dotenv;
use Illuminate\Console\Command;

class ListEnvCommand extends Command
{
    /** @var string */
    protected $signature = 'env:list';

    /** @var string */
    protected $description = 'List all the variables in the .env file';

    public function handle(): void
    {
        $this->table(['Key', 'Value'], collect(Dotenv::parse(
            file_get_contents(App::environmentFilePath())
        ))->sortKeys()->map(fn ($value, $key) => [$key, $value]));
    }
}
