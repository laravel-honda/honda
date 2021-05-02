<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLogsCommand extends Command
{
    /** @var string */
    protected $signature = 'clear:logs {file=laravel.log}';

    /** @var string */
    protected $description = 'Clears a given log file';

    public function handle()
    {
        $file = storage_path('logs/' . $this->argument('file'));

        if (!file_exists($file)) {
            $this->error('The given file does not exist.');

            return;
        }

        $result = file_put_contents($file, '');

        if ($result === false) {
            $this->error("Can not clear [$file]");

            return;
        }

        $this->info('Log file cleared successfully');
    }
}
