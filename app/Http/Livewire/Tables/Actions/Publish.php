<?php

namespace App\Http\Livewire\Tables\Actions;

use Honda\Table\Action;
use Illuminate\Database\Eloquent\Model;

class Publish extends Action
{
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->icon('send', 'tabler')
            ->execute(function (Model $model) {
                $model->publish();

                return redirect()->back();
            });
    }

    public static function create(string $name = 'Publish'): Action
    {
        return parent::create($name);
    }
}
