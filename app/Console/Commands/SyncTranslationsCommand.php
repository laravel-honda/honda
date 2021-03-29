<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncTranslationsCommand extends Command
{
    /** @var string */
    protected $signature = 'translations:sync';

    /** @var string */
    protected $description = 'Syncs translations between files and database';

    public function handle()
    {
        dd(__());
    }
}
