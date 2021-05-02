<?php

namespace App\Http\Livewire\Concerns;

use App\Models\Article;
use App\Models\Ingredient;

trait AddsIngredient
{
    public bool $addIngredientState = false;
    public $ingredient;
    public $quantity;

    public function addIngredient()
    {
        $ingredient = Ingredient::where('id', $this->ingredient)->first();

        if (!$ingredient) {
            $this->reset('ingredient');

            return $this->refresh();
        }

        if (!$this->quantity) {
            return $this->refresh();
        }

        /** @var Article $article */
        $this->article->ingredients()->save($ingredient, [
            'quantity' => $this->quantity,
        ]);

        return $this->refresh();
    }
}
