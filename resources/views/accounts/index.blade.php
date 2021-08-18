<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Cariler">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('accounts.create') }}" class="btn">Cari oluştur</a>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="card card-table">
                        <div class="card-header">
                            <x-tabler::table-search />
                        </div>
                        <x-tabler::table>
                            <thead>
                                <tr>
                                    <th>Cari</th>
                                    <th>e-Posta adresi</th>
                                    <th>Telefon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr data-url="{{ $route = route('accounts.show', $account) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $account->name }}</a>
                                        </td>
                                        <td>{{ $account->email ?: '-' }}</td>
                                        <td>{{ $account->phone ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $accounts->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>