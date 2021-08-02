@if ($label)
    <x-form-label for="{{ $id() }}" text="{{ $label }}" />
@endif

{{ $prepend ?? null }}

<input
    type="{{ $type }}"
    id="{{ $id() }}"
    name="{{ $name }}"
    value="{{ $value }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
>

{{ $append ?? null }}