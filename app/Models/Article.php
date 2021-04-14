<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'draft' => 'bool',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot(['quantity']);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function publish(): Article
    {
        $this->update([
            'draft' => false,
        ]);

        return $this;
    }

    public function draft(): Article
    {
        $this->update([
            'draft' => true,
        ]);

        return $this;
    }

    public function bannerImage()
    {
        return $this->belongsTo(Image::class, 'banner_image');
    }

    protected function getSlugColumn(): string
    {
        return 'title';
    }
}
