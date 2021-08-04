<div class="form-check">
    <input {{ $attributes->merge(['class' => 'form-check-input ' . ($hasError($name) ? 'is-invalid' : '')]) }}
        type="radio"

        @if($isWired())
            wire:model{!! $wireModifier() !!}="{{ $name }}"
        @else
            name="{{ $name }}"
        @endif

        value="{{ $value }}"

        @if($checked)
            checked="checked"
        @endif

        @if($label && !$attributes->get('id'))
            id="{{ $id() }}"
        @endif
    />

    <div class="ms-2">
        <x:form-label :for="$attributes->get('id') ?: $id()" class="form-check-label">
            {{ $label }}
            {{ $help ?? NULL }}
        </x:form-label>
    </div>

    @if($hasErrorAndShow($name))
        <x:form-errors :name="$name" />
    @endif
</div>