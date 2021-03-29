<?php

namespace App\Console\Commands;

use App;
use Dotenv\Dotenv;
use Illuminate\Console\Command;

class ListEnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the variables in the .env file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->table(['Key', 'Value'], collect(Dotenv::parse(
            file_get_contents(App::environmentFilePath())
        ))->map(fn ($value, $key) => [$key, $value]));
    }
}
