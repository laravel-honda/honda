<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetEnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:get {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves the value of an env variable.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $key = $this->argument('key');

        $this->table(['Key', 'Value'], [$key, env($key) ?? 'null']);
    }
}
