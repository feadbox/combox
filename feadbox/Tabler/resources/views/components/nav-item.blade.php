@props([
    'label',
    'route',
    'routeIs' => null,
    'icon',
    'hasChild' => false,
    'isActive' => false,
])

@php
    if (request()->routeIs($routeIs)) {
        $isActive = true;
    }

    $attributes = $attributes->merge([
        'class' => implode(' ', [
            'nav-link',
            $isActive ? 'active' : null,
            $hasChild ? 'dropdown-toggle' : null,
        ]),
        'href' => $route ?? '#',
    ]);

    if ($hasChild) {
        $attributes = $attributes->merge([
            'href' => '#navbar-base',
            'data-bs-toggle' => 'dropdown',
            'role' => 'button',
            'aria-expanded' => false,
        ]);
    }
@endphp

<li class="nav-item {{ $hasChild ? 'dropdown' : '' }} {{ $isActive ? 'active' : '' }}">
    <a {{ $attributes }}>
        @if ($icon ?? null)
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <x-dynamic-component component="tabler-{{ $icon }}" />
            </span>
        @endif 
        <span class="nav-link-title">{{ $label }}</span>
    </a>
    @if ($hasChild)
        <div class="dropdown-menu">
            {{ $slot }}
        </div>
    @endif
</li>