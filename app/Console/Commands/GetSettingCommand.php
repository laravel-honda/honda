<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Valuestore\Valuestore;

class GetSettingCommand extends Command
{
    protected $signature   = 'settings:get {key}';
    protected $description = 'Gets the value of a global setting';

    public function handle(): void
    {
        $value = app(Valuestore::class)->get(
            $key = $this->argument('key')
        );

        $this->info("Showing the value of [$key] in the settings:");

        dump($value);
    }
}
