<?php

namespace App\Http\Livewire\Concerns;

use App\Models\Ingredient;

trait CreatesIngredient
{
    public bool $createIngredientState = false;

    public $name;
    public $type;
    public $contains_gluten;
    public $contains_lactose;


    public function createIngredient()
    {
        Ingredient::create([
            'name'             => $this->name,
            'type'             => $this->type,
            'contains_gluten'  => $this->contains_gluten ?? false,
            'contains_lactose' => $this->contains_lactose ?? false,
        ]);

        return $this->refresh();
    }
}
