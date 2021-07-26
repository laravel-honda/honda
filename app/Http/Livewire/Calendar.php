<?php

namespace App\Http\Livewire;

use App\Models\Block;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Calendar extends Component
{
    public function render(): View
    {
        return view('livewire.calendar', [
            'blocks' => Block::query()
                ->where('user_id', Auth::id())
                ->where(fn (Builder $builder) => $builder
                    ->where([
                        'starts_at', '>=', today(),
                        'ends_at', '<', today()->addWeek(),
                    ])
                    ->orWhereNotNull('cron'))
                ->get()
                ->filter(function (Block $block) {
                    if ($block->cron === null) {
                        return true;
                    }

                    return $block->cron->isDue(
                        today()->toDateTime()
                    );
                })->groupBy(function (Block $block) {
                    if ($block->starts_at !== null) {
                        return $block->starts_at->format('Y-m-d');
                    }

                    return Carbon::parse($block->cron->getNextRunDate())->format('Y-m-d');
                }),
        ]);
    }
}
