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
                            <div>Davut Kember</div>
                            <div class="mt-1 small text-muted">Sorumlu</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <form action="#" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Oturumu kapat</button>
                        </form>
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
                <x-tabler::nav-item
                    label="Ayarlar"
                    :route-is="['branches.*', 'positions.*']"
                    icon="settings"
                    has-child
                >
                    <a href="{{ route('branches.index') }}" class="dropdown-item">
                        <x-tabler-apps class="dropdown-item-icon" />
                        <span>Şubeler</span>
                    </a>
                    <a href="{{ route('positions.index') }}" class="dropdown-item">
                        <x-tabler-apps class="dropdown-item-icon" />
                        <span>Pozisyonlar</span>
                    </a>
                </x-tabler::nav-item>
            </x-slot>
        </x-tabler::app-navbar>

        <div class="page-wrapper">
            {{ $slot }}

            {{-- <x-tabler::footer /> --}}
        </div>
    </div>
</x-tabler::app>