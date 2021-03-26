<?php

namespace App\Providers;

use App\Support\Alert;
use Honda\Navigation\Item;
use Honda\Navigation\Navigation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Navigation::register('dashboard', function (Navigation $navigation) {
            return $navigation
                ->add('hello', fn(Item $item) => $item->icon('circle-check'));
        });
    }

}
