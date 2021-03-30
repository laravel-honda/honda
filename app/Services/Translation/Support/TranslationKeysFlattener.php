<?php

namespace App\Services\Translation\Support;

use Generator;
use Illuminate\Support\Collection;

class TranslationKeysFlattener
{
    /**
     * @param array|Collection $iterable
     * @param string $separator
     * @return array
     */
    public static function flatten($iterable, string $separator = '.'): array
    {
        return iterator_to_array(static::flattenGenerator($iterable, $separator, ''));
    }

    /**
     * @param array|Collection $iterable
     * @param string $separator
     * @param string $prefix
     * @return Generator
     */
    protected static function flattenGenerator($iterable, string $separator, string $prefix): Generator
    {
        if (!is_iterable($iterable)) {
            yield $prefix => $iterable;

            return;
        }

        $prefix .= empty($prefix) ? '' : $separator;
        foreach ($iterable as $key => $value) {
            foreach (static::flattenGenerator($value, $separator, $prefix . $key) as $k => $v) {
                yield $k => $v;
            }
        }
    }
}
