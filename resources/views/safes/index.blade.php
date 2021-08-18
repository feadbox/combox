<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Kasalar">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('safes.create') }}" class="btn">Kasa oluştur</a>
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
                                    <th>Kasa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($safes as $safe)
                                    <tr data-url="{{ $route = route('safes.show', $safe) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $safe->name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $safes->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>