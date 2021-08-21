<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Ürün Alımları" />
                <div class="page-body">
                    <div class="card card-table">
                        <div class="card-header">
                            <x-tabler::table-search>
                                <x-form-select
                                    name="branch"
                                    :options="$branches"
                                    onchange="this.parentElement.submit()"
                                    :default="request('branch')"
                                />
                                <x-form-select
                                    name="date"
                                    :options="$dates"
                                    onchange="this.parentElement.submit()"
                                    :default="$selectedDate->format('Y-m')"
                                />
                            </x-tabler::table-search>
                        </div>
                        <x-tabler::table>
                            <thead>
                                <tr>
                                    <th>Etiket</th>
                                    <th>Toplam harcama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ Money::format($tagPayments->firstWhere('id', $tag->id)?->price * -1) }}</td>
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