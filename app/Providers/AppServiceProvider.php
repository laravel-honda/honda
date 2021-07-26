<?php

namespace App\Providers;

use App\Support\Faker\CronExpressionGenerator;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Honda\Navigation\Navigation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Navigation::macro('dashboard', function (Navigation $navigation) {
            $navigation->add('Blocks');
        });
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new CronExpressionGenerator($faker));

            return $faker;
        });
        Carbon::macro('asDay', function () {
            return $this->hours(0)->minutes(0)->seconds(0)->milliseconds(0);
        });
    }

    public function boot(): void
    {

    }
}
