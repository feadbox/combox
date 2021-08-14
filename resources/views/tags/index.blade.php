<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Etiketler">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('tags.create') }}" class="btn">Etiket oluştur</a>
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
                                    <th>Etiket</th>
                                    <th>Koleksiyon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr data-url="{{ $route = route('tags.edit', $tag) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $tag->name }}</a>
                                        </td>
                                        <td>{{ $tag->collection }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $tags->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>