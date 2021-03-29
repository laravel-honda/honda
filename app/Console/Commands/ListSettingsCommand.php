<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Valuestore\Valuestore;

class ListSettingsCommand extends Command
{
    protected $signature   = 'settings:list';
    protected $description = 'Lists all the global settings defined';

    public function handle(): void
    {
        $rows = collect(app(Valuestore::class)->all())->map(function ($value, $key) {
            return [$key, is_array($value) ? json_encode($value, JSON_THROW_ON_ERROR) : $value];
        })->values();

        $this->table(['Key', 'Value'], $rows);
    }
}
