<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Hesaplar">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('accounts.transfers.index') }}" class="btn">Transfer</a>
                            <a href="{{ route('accounts.create') }}" class="btn">Hesap oluştur</a>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="mb-3">
                        <x-tabler::table-search />
                    </div>
                    <div class="row">
                        @foreach ($accounts as $account)
                            <div class="col-lg-4">
                                <a href="{{ route('accounts.show', $account) }}" class="card card-body mb-3">
                                    <h3 class="card-title mb-2">{{ $account->name }}</h3>
                                    <h1 class="mb-3 text-{{ $account->isDebt() ? 'danger' : 'success' }}">{{ Money::format(abs($account->total())) }}</h1>
                                    <div>
                                        <div class="badge">{{ $account->account_type->title }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <x-tabler::paginate>
                        {{ $accounts->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>