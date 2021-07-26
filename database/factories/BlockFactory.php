<?php

namespace Database\Factories;

use App\Models\Block;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition(): array
    {
        $seed    = random_int(1, 3);
        $default = ['title' => $this->faker->text(60)];

        if ($seed === 1 || $seed === 3) {
            $default['cron'] = $this->faker->cron;
        }

        if ($seed === 2 || $seed === 3) {
            $default['starts_at'] = now()->subHours($this->faker->numberBetween(1, 24 * 5));
            $default['ends_at']   = now()->addHours($this->faker->numberBetween(0, 24 * 14));
        }

        return $default;
    }
}
