<?php

namespace App\Console\Commands\Env;

use Illuminate\Console\Command;

class GetEnvCommand extends Command
{
    /** @var string */
    protected $signature = 'env:get {key}';

    /** @var string */
    protected $description = 'Retrieves the value of an env variable.';

    public function handle(): void
    {
        $key = $this->argument('key');

        $this->table(['Key', 'Value'], [$key, env($key) ?? 'null']);
    }
}
