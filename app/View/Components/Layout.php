<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public string $title;
    public string $description;

    public function __construct(string $title, string $description = '')
    {
        $this->title       = $title;
        $this->description = $description;
    }

    public function render()
    {
        return view('components.layout', [
            'title'       => $this->title,
            'description' => $this->description,
        ]);
    }
}
