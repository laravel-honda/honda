<?php

namespace App\View\Components;

use Honda\Ui\Components\Input;

class Radio extends Input
{
    public array $values;
    /** @var mixed */
    public $selected = '';

    public function __construct(array $values = [], $selected = null, string $name = null, string $label = null, string $type = null, string $icon = null, string $iconSet = 'tabler', bool $first = false, string $color = null)
    {
        parent::__construct($name, $label, $type, $icon, $iconSet, $first, $color);

        $this->values   = $values;
        $this->selected = $selected ?? array_key_first($this->values);
    }

    public function render()
    {
        return view('components.radio');
    }
}
