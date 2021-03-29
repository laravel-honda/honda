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
        if (config('logging.default') !== 'stack') {
            return $this->error('The clear:logs command only works with the [stack] log driver');
        }

        $file = storage_path('logs/' . $this->argument('file'));

        if (!file_exists($file)) {
            return $this->error('The given file does not exist.');
        }

        $result = file_put_contents($file, '');

        if ($result === false) {
            return $this->error("Can not clear [$file]");
        }

        $this->info('Log file cleared successfully');
    }
}
