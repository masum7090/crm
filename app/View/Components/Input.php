<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $value;
    public $type;
    public $placeholder;

    public function __construct(
        $label = null,
        $name = null,
        $value = null,
        $type = 'text',
        $placeholder = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.input');
    }
}
