<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Ürünler">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('products.create') }}" class="btn">Ürün oluştur</a>
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
                                    <th>Ürün</th>
                                    <th>Birim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr data-url="{{ $route = route('products.edit', $product) }}">
                                        <td class="has-link">
                                            <a href="{{ $route }}">{{ $product->title }}</a>
                                        </td>
                                        <td>{{ $product->unit->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $products->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>