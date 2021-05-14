<?php

namespace App\Console\Commands\Settings;

use Illuminate\Console\Command;
use Spatie\Valuestore\Valuestore;

class GetSettingCommand extends Command
{
    /** @var string */
    protected $signature = 'settings:get {key}';
    /** @var string */
    protected $description = 'Gets the value of a global setting';

    public function handle(): void
    {
        $value = app(Valuestore::class)->get($this->argument('key'));

        dump($value);
    }
}
