<form {{ $attributes->merge(['class' => 'w-100 d-flex align-items-center justify-space-between gap-3']) }}>
    <div class="input-icon w-100">
        <x-form-input name="q" placeholder="{{ __('Search...') }}" :default="request('q')">
            <x-slot name="append">
                <span class="input-icon-addon">
                    <x-tabler-search class="icon" />
                </span>
            </x-slot>
        </x-form-input>
    </div>
    {{ $slot }}
</form>