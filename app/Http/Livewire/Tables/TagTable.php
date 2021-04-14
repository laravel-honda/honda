<?php

namespace App\Http\Livewire\Tables;

use App\Models\Tag;
use Honda\Table\Actions\Delete;
use Honda\Table\Actions\Edit;
use Honda\Table\Column;
use Honda\Table\Components\Table;

class TagTable extends Table
{
    public static string $model = Tag::class;

    public function columns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->searchable(),
            Column::make('slug')->labeledAs('URL'),
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
