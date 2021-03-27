<?php

namespace App\Providers;

use App\Support\Alert;
use App\Support\Mixins\CollectionMixin;
use App\Support\Mixins\StrMixin;
use Blade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use ImLiam\BladeHelper\Facades\BladeHelper;
use Spatie\Valuestore\Valuestore;
use View;

class HondaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(Valuestore::class, fn () => Valuestore::make(storage_path('app/settings.json')));
        $this->app->bind('settings', fn () => app(Valuestore::class));
        $this->app->singleton(Alert::class, fn () => new Alert());

        View::share(['settings' => app('settings')]);

        ComponentAttributeBag::macro('hasAnyOf', function (...$attributes) {
            return count(
                    $this->filter(fn ($_, $attribute) => in_array($attribute, $attributes))->getAttributes()
                ) > 0;
        });
    }

    public function register(): void
    {
        Model::unguard();
        Factory::guessFactoryNamesUsing(fn (string $model) => 'Database\\Factories\\' . class_basename($model) . 'Factory');

        $this->registerMacros();
        $this->registerBladeDirectives();
    }

    private function registerMacros(): void
    {
        Collection::mixin(new CollectionMixin());
        Str::mixin(new StrMixin());
    }

    public function registerBladeDirectives(): void
    {
        BladeHelper::directive('setting', fn ($key) => app('settings')->get($key));
        BladeHelper::directive('markdown', fn ($markdown) => Markdown::parse($markdown));
        Blade::directive('alpine', function (string $variables) {
            return <<<PHP
                <?php
                    \$data = array_combine(
                        array_map(
                            fn (\$variable) => str_replace('$', '', \$variable),
                            explode(',', '$variables')
                        ),
                        [$variables]
                    )

                    echo trim(
                        str_replace(["'", '"'], ["\'", "'"], json_encode(\$data)),
                        '{}'
                    );
                ?>
            PHP;
        });
    }
}
