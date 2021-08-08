<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Şubeler">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('branches.create') }}" class="btn">Şube oluştur</a>
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
                                    <th>Şube</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr data-url="{{ $route = route('branches.edit', $branch) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $branch->name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $branches->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>