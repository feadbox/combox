<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header :title="$product->title" :back-route="route('reports.product-transactions.index', ['branch' => request('branch'), 'date' => $selectedDate->format('Y-m')])" />
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
                                    <th>Tutar</th>
                                    <th>Adet</th>
                                    <th>Tarih</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ Money::format($transaction->price) }}</td>
                                        <td>{{ $transaction->quantity }} {{ $product->unit->title }}</td>
                                        <td>{{ $transaction->transaction_date->translatedFormat('j F') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate>
                        {{ $transactions->links() }}
                    </x-tabler::paginate>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>