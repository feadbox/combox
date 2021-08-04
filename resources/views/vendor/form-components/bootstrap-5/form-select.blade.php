<x:form-label
    :label="$label"
    :for="$attributes->get('id') ?: $id()"
    :required="$attributes->get('required')"
    class="form-label"
/>

{{ $hint ?? null }}

<select
    @if($isWired())
        wire:model{!! $wireModifier() !!}="{{ $name }}"
    @else
        name="{{ $name }}"
    @endif

    @if($multiple)
        multiple
    @endif

    @if($label && !$attributes->get('id'))
        id="{{ $id() }}"
    @endif

    {!! $attributes->merge(['class' => 'form-select' . ($hasError($name) ? ' is-invalid' : '')]) !!}>
    @if (!$multiple)
        <option value="">@lang('Bir öğe seçin')</option>
    @endif
    @forelse($options as $key => $option)
        <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>{{ $option }}</option>
    @empty
        {!! $slot !!}
    @endforelse
</select>

{!! $help ?? null !!}

@if($hasErrorAndShow($name))
    <x:form-errors :name="$name" />
@endif
