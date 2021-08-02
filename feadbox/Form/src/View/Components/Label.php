<?php

namespace Feadbox\Form\View\Components;

use Illuminate\View\View;

class Label extends Component
{
    public function __construct(
        public string $text,
        public string $for,
        public bool $required = false,
    ) {
        //
    }

    public function render(): View
    {
        return view('form::label');
    }
}
