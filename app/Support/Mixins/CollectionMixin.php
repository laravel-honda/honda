<?php

namespace App\Support\Mixins;

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

    public function mapWithoutKeys(): callable
    {
        return function (callable $callable) {
            return $this->map(function ($value) use ($callable) {
                return $callable($value);
            });
        };
    }
}
