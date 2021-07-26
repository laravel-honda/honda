<?php

use App\Models\Block;
use App\Models\User;
use App\Scheduler\Scheduler;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('works', function () {
    User::factory()->create();
    $this->actingAs(User::first());

    Block::create([
        'user_id'   => Auth::id(),
        'title'     => 'Block #2',
        'starts_at' => today()->addHours(8),
        'ends_at'   => today()->addHours(12),
        'cron'      => null,
    ]);

    Block::create([
        'user_id'   => Auth::id(),
        'title'     => 'Block #3',
        'starts_at' => today()->subMonth(),
        'ends_at'   => today()->addMonths(3),
        'cron'      => '0 5 * * *',
    ]);

    Block::create([
        'user_id' => Auth::id(),
        'title'   => 'Block #3',
        'cron'    => '0 1 * * 1',
    ]);

    $schedule = (new Scheduler(Block::all()))->getScheduleForPeriod(
        CarbonPeriod::create(
            today(),
            today()->addWeek()
        )
    );

    expect($schedule)->toHaveCount(1 + 7);
});
