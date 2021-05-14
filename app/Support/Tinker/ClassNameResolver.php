<?php


namespace App\Support\Tinker;


use Illuminate\Support\Collection;
use ReflectionClass;

class ClassNameResolver
{
    public Collection $classes;

    public function __construct()
    {
        $classFiles = include base_path('vendor/composer/autoload_classmap.php');

        $this->classes = collect($classFiles)
            ->map(function (string $path, string $fqcn) {
                $name = last(explode('\\', $fqcn));

                return compact('fqcn', 'name');
            })
            ->filter()
            ->values();
    }

    public function registerAutoloader(): void
    {
        spl_autoload_register([$this, 'aliasClass']);
    }

    public function aliasClass($findClass): void
    {
        $class = $this->classes->first(function ($class) use ($findClass) {
            if ($class['name'] !== $findClass) {
                return false;
            }

            return !(new ReflectionClass($class['fqcn']))->isInterface();
        });

        if (!$class) {
            return;
        }

        class_alias($class['fqcn'], $class['name']);
    }
}
