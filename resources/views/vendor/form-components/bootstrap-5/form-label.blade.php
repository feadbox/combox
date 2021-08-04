@if($label || $slot->isNotEmpty())
    <label
        {{
            $attributes
                ->except('required')
                ->merge([
                    'class' => $attributes->get('required') ? 'required' : ''
                ])
        }}
    >{{ $label ?: $slot }}</label>
@endif