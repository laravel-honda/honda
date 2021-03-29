<?php

namespace App\Console\Commands;

use Arr;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

class DiscoverTailwindClasses extends Command
{
    /** @var string */
    protected $signature = 'tailwind:discover';

    /** @var string */
    protected $description = 'Discovers dynamic classes and protect them from purging';

    public function handle(): void
    {
        Collection::fromFiles(resource_path('views/'))
            ->map(fn (SplFileInfo $file) => $file->getContents())
            ->map(fn ($contents)         => call(app('blade.compiler'), 'compileComponentTags', $contents))
            ->map(fn ($contents)         => preg_replace('/\s/', '', $contents))
            ->map(function ($contents) {
                preg_match_all("/@component\\('(?'class'[a-zA-Z\\\\]+)','(?'component'[a-z\\-]+)',(?'attributes'.+?(?=])])/m",
                    $contents,
                    $matches,
                    PREG_SET_ORDER
                );

                return $matches;
            })
            ->filter()
            ->flatten(1)
            ->map(fn (array $match) => Arr::only($match, ['class', 'component', 'attributes']))
            ->map(function (array $match) {
                ['class' => $class, 'attributes' => $attributes, 'component' => $component] = $match;
                $class = '\\' . $class . '::class';
                $instance = eval(<<<EVAL
                    \$reflectionClass = new ReflectionClass($class);
                    \$instance = \$reflectionClass->newInstanceArgs($attributes);
                    return \$instance;
                EVAL);
            })
            ->dd();
    }
}
