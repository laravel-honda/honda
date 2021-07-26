<?php

namespace App\Casts;

use Cron\CronExpression;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CronCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?CronExpression
    {
        if ($value === null) {
            return null;
        }

        return new CronExpression($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
