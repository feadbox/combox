<x-form-label
    :label="$label"
    :for="$attributes->get('id') ?: $id()"
    :required="$attributes->get('required')"
    class="form-label"
/>

{{ $prepend ?? null }}

<textarea
    @if($isWired())
        wire:model{!! $wireModifier() !!}="{{ $name }}"
    @else
        name="{{ $name }}"
    @endif

    @if($label && !$attributes->get('id'))
        id="{{ $id() }}"
    @endif

    {!! $attributes->merge(['class' => 'form-control ' . ($hasError($name) ? 'is-invalid' : '')]) !!}
>@unless($isWired()){!! $value !!}@endunless</textarea>

{!! $append ?? null !!}

@if($hasErrorAndShow($name))
    <x-form-errors :name="$name" />
@endif