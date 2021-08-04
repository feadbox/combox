@props(['flat'])

<x-form-label
    :label="$label"
    :for="$attributes->get('id') ?: $id()"
    :required="$attributes->get('required')"
    class="form-label"
/>

{{ $prepend ?? null }}

<input
    {!! $attributes->except('group-flat')->merge(['class' => 'form-control ' . ($hasError($name) ? 'is-invalid' : '')]) !!}

    type="{{ $type }}"

    @if($isWired())
        wire:model{!! $wireModifier() !!}="{{ $name }}"
    @else
        name="{{ $name }}"
        value="{{ $value }}"
    @endif

    @if($label && !$attributes->get('id'))
        id="{{ $id() }}"
    @endif
/>

{{ $append ?? null }}

@if($hasErrorAndShow($name))
    <x-form-errors :name="$name" />
@endif
