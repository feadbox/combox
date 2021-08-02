<label for="{{ $for }}" {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $text }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>