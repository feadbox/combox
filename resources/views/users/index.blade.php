<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Çalışanlar">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('users.create') }}" class="btn">Çalışan ekle</a>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="card card-table">
                        <div class="card-header">
                            <div class="w-100">
                                <div class="text-muted mb-2">
                                    <strong>{{ $users->total() }}</strong> kayıtlı çalışan
                                </div>
                                <x-tabler::table-search />
                            </div>
                        </div>
                        <x-tabler::table>
                            <thead>
                                <tr>
                                    <th>Çalışan</th>
                                    <th>Pozisyon</th>
                                    <th>Telefon numarası</th>
                                    <th>Çalışıyor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr data-url="{{ $route = route('users.show', $user) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $user->full_name }}</a>
                                        </td>
                                        <td>{{ $user->position->name }}</td>
                                        <td>{{ $user->phone ?: '-' }}</td>
                                        <td>{{ $user->isCurrentlyWork() ? 'Evet' : 'Hayır' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $users->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>