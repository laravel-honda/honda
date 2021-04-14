<?php

namespace App\Providers;

use App\Models\Article;
use Honda\Navigation\Item;
use Honda\Navigation\Navigation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Navigation::macro('manager', function (Navigation $navigation) {
            return $navigation
                ->add('Articles', fn (Item $item) => $item
                    ->icon('news')
                    ->activePattern('^/manager/articles')
                    ->href('articles.index')
                )->add('Tags', fn (Item $item) => $item
                    ->icon('tag')
                    ->activePattern('^/manager/tags')
                    ->href('tags.index')
                )->add('Catégories', fn (Item $item) => $item
                    ->icon('bookmarks')
                    ->activePattern('^/manager/categories')
                    ->href('categories.index')
                )
                ->add('Ingrédients', fn (Item $item) => $item
                    ->icon('tools-kitchen-2')
                    ->activePattern('^/manager/ingredients')
                    ->href('ingredients.index')
                );
        });

    }

    public function boot(): void
    {
    }
}
