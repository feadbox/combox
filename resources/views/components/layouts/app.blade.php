<x-tabler::app>
    <x-slot name="head">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>{{ config('app.name') }}</title>
        {{ $head ?? null }}
    </x-slot>

    <x-slot name="scripts">
        <script src="{{ mix('js/app.js') }}"></script>
        {{ $scripts ?? null }}
    </x-slot>

    <div class="wrapper">
        <x-tabler::app-header>
            <x-slot name="logo">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
            </x-slot>
            <x-slot name="nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>Paweł Kuna</div>
                            <div class="mt-1 small text-muted">UI Designer</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Set status</a>
                        <a href="#" class="dropdown-item">Profile & account</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </x-slot>
        </x-tabler::app-header>
        
        <x-tabler::app-navbar>
            <x-slot name="nav">
                <x-tabler::nav-item
                    label="Dashboard"
                    :route="route('dashboard')"
                    route-is="dashboard"
                    icon="home"
                />
                <x-tabler::nav-item
                    label="Çalışanlar"
                    :route="route('users.index')"
                    route-is="users.*"
                    icon="users"
                />
            </x-slot>
        </x-tabler::app-navbar>

        <div class="page-wrapper">
            {{ $slot }}

            {{-- <x-tabler::footer /> --}}
        </div>
    </div>
</x-tabler::app>