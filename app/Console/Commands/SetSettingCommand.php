<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Valuestore\Valuestore;

class SetSettingCommand extends Command
{
    protected $signature   = 'settings:set {key} {value}';
    protected $description = 'Sets a global setting.';

    public function handle(): void
    {
        $store = app(Valuestore::class)->put(
            $key = $this->argument('key'),
            $value = $this->argument('value')
        );

        if ($store->get($key) === $value) {
            $this->info("Successfully set [$key] to [$value] in settings.json");
        } else {
            $this->error("Can not set [$key] to [$value] in settings.json");
        }
    }
}
