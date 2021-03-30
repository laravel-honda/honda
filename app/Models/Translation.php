<?php

namespace App\Models;

use App\Models\Concerns\HasUuidIdentifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    use HasUuidIdentifier;

    public $casts = [
        'entries' => 'json',
    ];

    public function hasTranslation(string $lang): bool
    {
        return isset($this->entries[$lang]);
    }

    public function getTranslation(string $lang): ?string
    {
        if (!$this->hasTranslation($lang)) {
            return null;
        }

        return $this->entries[$lang];
    }

    public function updateTranslation(string $lang, string $value): self
    {
        $this->update([
            'entries' => array_merge($this->entries, [$lang => $value]),
        ]);

        return $this;
    }
}
