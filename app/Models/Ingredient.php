<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;
    use HasSlug;

    public const TYPES = [
        'vegan'      => 'Vegan',
        'vegetarian' => 'Végétarien',
        'meat'       => 'Carné',
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function getHumanFriendlyTypeAttribute(): string
    {
        return static::TYPES[$this->type];
    }
}
