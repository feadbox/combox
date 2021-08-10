@props(['id', 'size' => 'md'])

<div class="modal modal-blur fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-{{ $size }}" role="document">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>