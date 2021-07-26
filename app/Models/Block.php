<?php

namespace App\Models;

use App\Casts\CronCast;
use App\Models\Concerns\WithUuid;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    use HasFactory;
    use WithUuid;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'cron'      => CronCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shouldBeDone(CarbonInterface $day): bool
    {
        if ($this->hasNoLimits() && $this->hasCronExpression()) {
            return $this->checkCron($day);
        }

        if ($this->hasLimits() && $this->hasCronExpression()) {
            return $this->checkCron($day) && $this->checkLimits($day);
        }

        return $this->checkLimits($day);
    }

    /**
     * Returns true if starts_at and ends_at are null.
     */
    public function hasNoLimits(): bool
    {
        return !$this->hasLimits();
    }

    /**
     * Returns true if starts_at and ends_at are not null.
     */
    public function hasLimits(): bool
    {
        return $this->starts_at !== null && $this->ends_at !== null;
    }

    /**
     * Returns true if the block has a cron expression associated with it.
     */
    public function hasCronExpression(): bool
    {
        return $this->cron !== null;
    }

    public function checkCron(CarbonInterface $day): bool
    {
        return Carbon::parse($this->cron->getPreviousRunDate())->asDay()->equalTo($day) ||
            Carbon::parse($this->cron->getNextRunDate())->asDay()->equalTo($day);
    }

    protected function checkLimits(CarbonInterface $day): bool
    {
        return $this->starts_at->asDay()->lte($day) && // <=
            $this->ends_at->asDay()->gte($day);    // >=
    }
}
