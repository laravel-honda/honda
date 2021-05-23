<?php

namespace App\Console\Commands;

use Artisan;
use Closure;
use DB;
use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /** @var string */
    protected $signature = 'setup';
    /** @var string */
    protected $description = 'Configure the project after a fresh install';

    public function handle(): void
    {
        foreach ($this->commands() as $message => $command) {
            if (is_string($command)) {
                $this->command($command);
            }

            if ($command instanceof Closure) {
                $command->bindTo($this)();
            }

            if (is_string($message)) {
                $this->info(
                    $message . (!str_ends_with($message, '.') ? '.' : '')
                );
            }
        }
        $this->output->success('Project set up successfully.');
    }

    public function commands(): array
    {
        return [
            'Copied .env.example to .env'  => fn ()  => copy(base_path('.env.example'), base_path('.env')),
            'Generated a fresh secret key' => fn () => Artisan::call('key:generate'),
            'Created a new database'       => fn ()       => file_put_contents(
                database_path('database.sqlite'),
                ''
            ),
            'Migrated the database' => function () {
                DB::disconnect();
                Artisan::call('migrate');
            },
        ];
    }

    public function command(string $command): bool | string | null
    {
        return shell_exec('cd ' . base_path() . ';' . $command);
    }
}
