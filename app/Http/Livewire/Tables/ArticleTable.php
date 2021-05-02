<?php

namespace App\Http\Livewire\Tables;

use App\Models\Article;
use Honda\Table\Actions\Delete;
use Honda\Table\Actions\Edit;
use Honda\Table\Column;
use Honda\Table\Components\Table;

class ArticleTable extends Table
{
    public static string $model = Article::class;

    public function columns(): array
    {
        return [
            Column::make('title')->searchable(),
            Column::make('making_time'),
            Column::make('draft')->asBool(),
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
