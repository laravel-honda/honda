<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class PivotMigrationMakeCommand extends GeneratorCommand
{
    /** @var string */
    protected $name = 'make:migration:pivot';

    /** @var string */
    protected $description = 'Create a new migration pivot class';

    /** @var string */
    protected $type = 'Migration';

    /**
     * Get the first and second table name from input.
     */
    protected function getNameInput(): string
    {
        return '';
    }

    protected function getPath($name = null): string
    {
        return base_path() . '/database/migrations/' . date('Y_m_d_His') .
            '_create_' . $this->getPivotTableName() . '_pivot_table.php';
    }

    protected function getPivotTableName(): string
    {
        return implode('_', $this->getSortedSingularTableNames());
    }

    protected function getSortedSingularTableNames(): array
    {
        $tables = array_map('Str::singular', $this->getTableNamesFromInput());

        sort($tables);

        return $tables;
    }

    protected function getTableNamesFromInput(): array
    {
        return [
            strtolower($this->argument('tableOne')),
            strtolower($this->argument('tableTwo')),
        ];
    }

    protected function buildClass($name = null): string
    {
        $stub = $this->files->get($this->getStub());

        return $this->replacePivotTableName($stub)
            ->replaceSchema($stub)
            ->replaceClass($stub, $this->getClassName());
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../stubs/pivot.stub';
    }

    protected function replaceClass($stub, $name): string
    {
        return str_replace('{{class}}', $name, $stub);
    }

    protected function replaceSchema(string &$stub): self
    {
        $tables = array_merge(
            $this->getSortedSingularTableNames(),
            $this->getSortedTableNames()
        );

        $stub = str_replace(
            ['{{columnOne}}', '{{columnTwo}}', '{{tableOne}}', '{{tableTwo}}'],
            $tables,
            $stub
        );

        return $this;
    }

    protected function getSortedTableNames(): array
    {
        $tables = $this->getTableNamesFromInput();

        sort($tables);

        return $tables;
    }

    protected function replacePivotTableName(string &$stub): self
    {
        $stub = str_replace('{{pivotTableName}}', $this->getPivotTableName(), $stub);

        return $this;
    }

    protected function getClassName(): string
    {
        $name = implode('', array_map('ucwords', $this->getSortedSingularTableNames()));

        $name = preg_replace_callback('/(\_)([a-z]{1})/', function ($matches) {
            return Str::studly($matches[0]);
        }, $name);

        return "Create{$name}PivotTable";
    }

    protected function getArguments(): array
    {
        return [
            ['tableOne', InputArgument::REQUIRED, 'The name of the first table.'],
            ['tableTwo', InputArgument::REQUIRED, 'The name of the second table.'],
        ];
    }
}
