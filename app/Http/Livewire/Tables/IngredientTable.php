<?php

namespace App\Http\Livewire\Tables;

use App\Models\Ingredient;
use Honda\Table\Actions\Delete;
use Honda\Table\Actions\Edit;
use Honda\Table\Column;
use Honda\Table\Components\Table;

class IngredientTable extends Table
{
    public static string $model = Ingredient::class;

    public function columns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->searchable(),
            Column::make('human_friendly_type')->labeledAs('Type'),
            Column::make('slug')->labeledAs('URL'),
            Column::make('contains_gluten')->asBool(),
            Column::make('contains_lactose')->asBool(),
            Column::make('updated_at')->asDateDiff(),
            Column::make('actions')->containsActions(),
        ];
    }

    public function actions(): array
    {
        return [
            Edit::create('Éditer'),
            Delete::create('Supprimer'),
        ];
    }
}
