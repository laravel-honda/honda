<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static array $removableKeywords = [
        'de', 'des', 'd',
        'en',
        'a', 'au', 'aux',
        'le', 'la', 'les', 'l',
        'un', 'une', 'des',
        'mon', 'ma', 'mes', 'ton', 'ta', 'tes', 'son', 'sa', 'ses', 'notre', 'nos', 'vos', 'leur', 'leurs',
        'ce', 'cette', 'cet', 'ces',
    ];


    public function getSlugAttribute(): string
    {
        $value = $this->getAttributeValue($this->getSlugColumn());
        $words = explode('-', Str::slug($value));

        foreach ($words as $k => $word) {
            foreach (static::$removableKeywords as $keyword) {
                if ($word === $keyword) {
                    $words[$k] = null;
                }
            }
        }

        return implode('-', array_filter($words));
    }

    protected function getSlugColumn(): string
    {
        return 'name';
    }
}
