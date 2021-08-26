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
        @if (is_array($option) || $option instanceof \Illuminate\Support\Collection)
            <optgroup label="{{ $key }}">
                @foreach ($option as $childKey => $childOption)
                    <option value="{{ $childKey }}" @if($isSelected($childKey)) selected="selected" @endif>{{ $childOption }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>{{ $option }}</option>
        @endif
    @empty
        {!! $slot !!}
    @endforelse
</select>

{!! $help ?? null !!}

@if($hasErrorAndShow($name))
    <x:form-errors :name="$name" />
@endif
