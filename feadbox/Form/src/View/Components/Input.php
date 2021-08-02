<?php

namespace Feadbox\Form\View\Components;

use Illuminate\View\View;

class Input extends Component
{
    public $value;

    public function __construct(
        public string $name,
        public string $type = 'text',
        public ?string $label = null,
        public $default = null,
    ) {
        $this->value = old(static::convertBracketsToDots($name), $default);
    }

    public function render(): View
    {
        return view('form::input');
    }
}
