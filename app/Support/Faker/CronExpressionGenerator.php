<?php

namespace App\Support\Faker;

use Cron\CronExpression;
use Faker\Provider\Base;
use InvalidArgumentException;

class CronExpressionGenerator extends Base
{
    public function cron(): string
    {
        try {
            return $this->maybeValidCron();
        } catch (InvalidArgumentException) {
            return $this->cron();
        }
    }

    private function maybeValidCron(): CronExpression
    {
        return new CronExpression(sprintf(
            '%s %s %s %s %s',
            $this->cronForMinute(),
            $this->cronForHour(),
            $this->cronForMonthDay(),
            $this->cronForMonth(),
            $this->cronForWeekDay(),
        ));
    }

    private function cronForMinute(): string
    {
        return static::randomElement([
            ...array_fill(0, 30, '*'),
            ...range(0, 59),
        ]);
    }

    private function cronForHour(): string
    {
        return static::randomElement([
            ...array_fill(0, 23, '*'),
            ...range(0, 23),
        ]);
    }

    private function cronForMonthDay(): string
    {
        return static::randomElement([
            ...array_fill(0, 31, '*'),
            ...range(1, 31),
        ]);
    }

    private function cronForMonth(): string
    {
        return static::randomElement([
            ...array_fill(0, 12, '*'),
            ...range(1, 12),
        ]);
    }

    private function cronForWeekDay(): string
    {
        return static::randomElement([
            ...array_fill(0, 6, '*'),
            ...range(0, 6),
        ]);
    }
}
