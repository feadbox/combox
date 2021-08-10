@props(['id', 'action' => null, 'onConfirm' => null])

<x-tabler::modal id="{{ $id }}" size="sm">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    <div class="modal-status bg-danger"></div>
    <div class="modal-body text-center py-4">
        <x-tabler-alert-triangle class="mb-2 text-danger icon-lg" />
        <h3>{{ __('Are you sure?') }}</h3>
        <div class="text-muted">{{ __('This item will be permanently deleted.') }}</div>
    </div>
    <div class="modal-footer">
        <div class="w-100">
            @if (trim($slot))
                {{ $slot }}
            @else
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-white w-100" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger w-100 onclick:disabled" wire:loading.class="disabled" onclick="{{ $action ? "document.getElementById('{$id}-form').submit();" : $onConfirm }}">
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-tabler::modal>

@if ($action)
    <form id="{{ $id }}-form" action="{{ $action }}" method="post" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endif