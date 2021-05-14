<?php

namespace App\Models;

use App\Models\Concerns\HasUuidIdentifier;
use App\Models\Concerns\WithUuid;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OnlineMailable.
 *
 * @property string $id
 * @property mixed|null $content
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|OnlineMailable newModelQuery()
 * @method static Builder|OnlineMailable newQuery()
 * @method static Builder|OnlineMailable query()
 * @method static Builder|OnlineMailable whereContent($value)
 * @method static Builder|OnlineMailable whereCreatedAt($value)
 * @method static Builder|OnlineMailable whereExpiresAt($value)
 * @method static Builder|OnlineMailable whereId($value)
 * @method static Builder|OnlineMailable whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OnlineMailable extends Model
{
    use WithUuid;

    protected $casts = [
        'content' => 'encrypted',
    ];

    public function getSignedUrl(): string
    {
        return \URL::temporarySignedRoute('view-email-online', Carbon::parse($this->expires_at), [
            'onlineMailable' => $this,
        ]);
    }
}
