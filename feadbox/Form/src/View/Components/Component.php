<?php

namespace Feadbox\Form\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    /**
     * ID for this component.
     */
    private $id;

    /**
     * Generates an ID, once, for this component.
     */
    public function id(): string
    {
        if ($id = $this->attributes->get('id')) {
            return $this->id = $id;
        }

        if ($this->name) {
            return $this->id = $this->generateIdByName();
        }

        return $this->id = Str::random(4);
    }

    /**
     * Generates an ID by the name attribute.
     */
    protected function generateIdByName(): string
    {
        return "form_id_{$this->name}";
    }

    /**
     * Converts a bracket-notation to a dotted-notation
     */
    protected static function convertBracketsToDots(string $name): string
    {
        return str_replace(['[]', '[', ']'], ['', '.', ''], $name);
    }
}
