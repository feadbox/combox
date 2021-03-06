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
                <a href="{{ route('accounts.index') }}">{{ config('app.name') }}</a>
            </x-slot>
            <x-slot name="nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"></span>
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
                    label="Hesaplar"
                    :route="route('accounts.index')"
                    route-is="accounts.*"
                    icon="shield"
                    has-child
                >
                    @foreach ($accountTypes as $key => $type)
                        <a href="{{ route('accounts.index', ['type' => $key]) }}" class="dropdown-item">{{ $type }}</a>
                    @endforeach
                </x-tabler::nav-item>
                <x-tabler::nav-item
                    label="Raporlar"
                    route-is="reports.*"
                    icon="report-analytics"
                    has-child
                >
                    <a href="{{ route('reports.expenses.index') }}" class="dropdown-item">Gider raporu</a>
                    <a href="{{ route('reports.tags.index') }}" class="dropdown-item">Etiket raporu</a>
                </x-tabler::nav-item>
                <x-tabler::nav-item
                    label="??irket"
                    :route-is="['branches.*', 'positions.*', 'tags.*', 'users.*', 'products.*', 'salaries.*', 'tips.*']"
                    icon="settings"
                    has-child
                >
                    <a href="{{ route('users.index') }}" class="dropdown-item">
                        <x-tabler-users class="dropdown-item-icon" />
                        <span>??al????anlar</span>
                    </a>
                    <a href="{{ route('salaries.index') }}" class="dropdown-item">
                        <x-tabler-wallet class="dropdown-item-icon" />
                        <span>Maa??lar</span>
                    </a>
                    <a href="{{ route('tips.index') }}" class="dropdown-item">
                        <x-tabler-coin class="dropdown-item-icon" />
                        <span>Tip</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="dropdown-item">
                        <x-tabler-barcode class="dropdown-item-icon" />
                        <span>??r??nler</span>
                    </a>
                    <a href="{{ route('branches.index') }}" class="dropdown-item">
                        <x-tabler-building-store class="dropdown-item-icon" />
                        <span>??ubeler</span>
                    </a>
                    <a href="{{ route('positions.index') }}" class="dropdown-item">
                        <x-tabler-apps class="dropdown-item-icon" />
                        <span>Pozisyonlar</span>
                    </a>
                    <a href="{{ route('tags.index') }}" class="dropdown-item">
                        <x-tabler-tag class="dropdown-item-icon" />
                        <span>Etiketler</span>
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