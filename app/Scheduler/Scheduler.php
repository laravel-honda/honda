<?php

namespace App\Scheduler;

use App\Models\Block;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class Scheduler
{
    /** @var Block[]|Collection */
    private Collection $blocks;

    public function __construct(Collection $blocks)
    {
        $this->blocks = $blocks;
    }

    public function getScheduleForPeriod(CarbonPeriod $period): array
    {
//        $blocks = Block::query()
//            ->where('user_id', $this->user->id)
//            ->where(function (Builder $builder) use ($period) {
//                $builder->where(function (Builder $builder) use ($period) {
//                    $builder
//                        ->where('starts_at', '>=', $period->getStartDate())
//                        ->where('ends_at', '<=', $period->getEndDate());
//                })->orWhereNotNull('cron');
//            })->get();

        $schedule = [];

        foreach ($period as $day) {
            $schedule[$day->toDateString()] = [];

            foreach ($this->blocks as $block) {
                if ($block->shouldBeDone($day)) {
                    $schedule[$day->toDateString()][] = $block;
                }
            }
        }

        return $schedule;
    }
}
