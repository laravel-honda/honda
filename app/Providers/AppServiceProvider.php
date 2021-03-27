<?php

namespace App\Providers;

use App\Support\Alert;
use Honda\Navigation\Item;
use Honda\Navigation\Navigation;
use Honda\Navigation\Section;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Navigation::register('dashboard', function (Navigation $navigation) {
            return $navigation
                ->add('Dashboard', fn(Item $item) => $item->icon('circle-check'))
                ->section('Analytics', function (Section $section) {
                    return $section
                        ->add('Dude', fn(Item $item) => $item
                            ->icon('access-point-off')
                            ->description('Get a better understanding of where your traffic is coming from.')
                        )
                        ->add('Work', fn(Item $item) => $item
                            ->icon('ambulance')
                            ->description('Speak directly to your customers in a more meaningful way.')
                        );
                });
        });
    }

}
