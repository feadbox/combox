<form class="input-icon w-100">
    <x-form-input name="q" placeholder="{{ __('Search...') }}">
        <x-slot name="append">
            <span class="input-icon-addon">
                <x-tabler-search class="icon" />
            </span>
        </x-slot>
    </x-form-input>
</form>