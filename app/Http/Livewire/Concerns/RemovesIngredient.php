<?php


namespace App\Http\Livewire\Concerns;


use App\Http\Livewire\EditArticle;
use App\Models\Ingredient;

/**
 * @mixin EditArticle
 */
trait RemovesIngredient
{
    public function removeIngredient(Ingredient $ingredient)
    {
        $this->article->ingredients()->detach($ingredient);

        return $this->refresh();
    }
}
