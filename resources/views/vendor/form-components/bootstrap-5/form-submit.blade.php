<button {{ $attributes->merge([
    'class' => 'btn btn-primary',
    'type' => 'submit'
]) }}>
    {{ $slot->isEmpty() ? __('Save') : $slot }}
</button>