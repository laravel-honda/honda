<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ApplicationLogo extends Component
{
    public ?string $context;

    public function __construct(string $context = null)
    {
        $this->context = $context;
    }

    public function render()
    {
        return view('components.application-logo');
    }
}
