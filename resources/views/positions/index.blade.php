<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Pozisyonlar">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('positions.create') }}" class="btn">Pozisyon oluştur</a>
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
                                    <th>Pozisyon</th>
                                    <th>Varsayılan maaş</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $position)
                                    <tr data-url="{{ $route = route('positions.edit', $position) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $position->name }}</a>
                                        </td>
                                        <td>{{ $position->default_price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $positions->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>