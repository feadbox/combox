@props(['title', 'pretitle', 'subtitle', 'backRoute'])

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col d-flex">
            @if ($backRoute ?? null)
                <a href="{{ $backRoute }}" class="btn btn-sm btn-icon btn-light me-3">
                    <x-tabler-arrow-left />
                </a>
            @endif
            <div class="d-flex flex-column justify-content-center">
                @if ($pretitle ?? null)
                    <div class="page-pretitle">{{ $pretitle }}</div>
                @endif
                <h2 class="page-title">{{ $title }}</h2>
                @if ($subtitle ?? null)
                    <div class="text-muted mt-1">{{ $subtitle }}</div>
                @endif
                {{ $slot }}
            </div>
        </div>
        @if ($actions ?? null)
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
