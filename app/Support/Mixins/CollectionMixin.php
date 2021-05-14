<?php

namespace App\Support\Mixins;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * @mixin Collection
 */
class CollectionMixin
{
    public function fromFiles(): callable
    {
        return function (...$directories): Collection {
            $collection = collect();

            foreach ($directories as $directory) {
                if (!file_exists($directory)) {
                    continue;
                }
                $collection->push(
                    ...File::allFiles($directory)
                );
            }

            return $collection;
        };
    }

    public function any(): Closure
    {
        return function (callable $truthTest) {
            return any($this->toArray(), $truthTest);
        };
    }

    public function every(): Closure
    {
        return function (callable $truthTest) {
            return every($this->toArray(), $truthTest);
        };
    }

}
