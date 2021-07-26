<?php

namespace App\Rules;

use Cron\CronExpression;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

class CronExpressionOrNullRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if ($value === null) {
            return true;
        }

        try {
            new CronExpression($value);

            return true;
        } catch (InvalidArgumentException) {
            return false;
        }
    }

    public function message(): string
    {
        return 'The :attribute field contains an invalid cron expression.';
    }
}
