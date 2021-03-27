<?php

namespace App\Commands;

use Artisan;
use Closure;
use Illuminate\Console\Command;

class SetupCommand extends Command
{
    protected $signature = 'setup';
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

    public function commands()
    {
        return [
            'Copied .env.example to .env' => 'cp .env.example .env',
            'Generated a fresh secret key' => fn() => Artisan::call('key:generate'),
            'Created a new database' => fn() => file_put_contents(
                database_path('database.sqlite'),
                ''
            ),
            'Migrated the database' => fn() => Artisan::call('migrate'),
            function () {
                if (shell_exec('which valet') !== null) {
                    $siteName = explode('.', basename(base_path()))[0];

                    $this->command('valet link ' . $siteName);
                    $this->info("Linked your project to valet on [http://$siteName.test]");
                }
            },
        ];
    }

    public function command(string $command)
    {
        return shell_exec('cd ' . base_path() . ';' . $command);
    }
}
