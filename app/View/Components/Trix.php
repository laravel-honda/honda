<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Trix extends Component
{
    public string $name;
    public string $id;
    public string $styling;

    public function __construct(string $name, string $id = null, string $styling = 'trix-content')
    {
        $this->name    = $name;
        $this->id      = $id ?? $name;
        $this->styling = $styling;
    }

    public function render(): View
    {
        return view('components.trix');
    }
}
