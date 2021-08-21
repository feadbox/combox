<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <x-tabler::page-header :title="$account->name" :back-route="route('accounts.index', $account->forAccount() ? ['type' => 'account'] : ['type' => 'safe'])">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modal-buy">Ürün al</button>
                            <a href="{{ route('accounts.edit', $account) }}" class="btn">Düzenle</a>
                            @if (!$account->forBranch())
                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Kalıcı olarak sil</button>
                            @endif
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-body mb-3">
                                <div class="text-uppercase small mb-2">Toplam</div>
                                <div class="h1 text-{{ $account->isDebt() ? 'danger' : 'success' }}">
                                    {{ Money::format(abs($account->total())) }}
                                </div>
                            </div>
                            <div class="card card-body">
                                <h3 class="card-title">Alacak ekle</h3>
                                <form action="{{ route('accounts.payments.store', $account) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <x-form-input
                                            label="Tutar"
                                            name="price"
                                            required
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <x-form-textarea
                                            label="Açıklama"
                                            name="description"
                                            rows="4"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <x-form-input
                                            label="Tarih"
                                            type="date"
                                            name="payment_date"
                                            :default="today()->format('Y-m-d')"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-form-submit />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card card-table">
                                <x-tabler::table>
                                    <thead>
                                        <tr>
                                            <th>Tutar</th>
                                            <th>Açıklama</th>
                                            <th>Şube</th>
                                            <th>Ürün</th>
                                            <th>Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td class="text-{{ $payment->price->cents() < 0 ? 'danger' : 'success' }}">{{ Money::format(abs($payment->price->cents())) }}</td>
                                                <td>{{ $payment->description ?: '-' }}</td>
                                                <td>{{ $payment->branch->name ?? '-' }}</td>
                                                <td>
                                                    @if ($payment->relation instanceof App\Models\Product)
                                                        {{ $payment->relation->title }}
                                                        ({{ $payment->quantity }} {{ $payment->relation->unit->title }})
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $payment->payment_date->translatedFormat('j F Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </x-tabler::table>
                            </div>
                            <x-tabler::paginate>
                                {{ $payments->links() }}
                            </x-tabler::paginate>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-tabler::modal-destroy id="modal-delete" :action="route('accounts.destroy', $account)" />
    <x-tabler::modal id="modal-buy">
        <x-tabler::modal-header title="Ürün al" />
        <div class="modal-body">
            <form action="{{ route('accounts.products.store', $account) }}" method="post">
                @csrf
                <div class="mb-3">
                    <x-form-select
                        label="Ürün"
                        name="product"
                        :options="$products"
                        required
                    />
                </div>
                <div class="mb-3">
                    <x-form-select
                        label="Şube"
                        name="branch"
                        :options="$branches"
                    />
                </div>
                <div class="mb-3">
                    <x-form-input
                        label="Adet / KG"
                        type="number"
                        name="quantity"
                        required
                    />
                </div>
                <div class="mb-3">
                    <x-form-input
                        label="Toplam tutar"
                        name="price"
                        required
                    />
                </div>
                <div class="mb-3">
                    <x-form-input
                        label="Tarih"
                        type="date"
                        name="payment_date"
                        :default="today()->format('Y-m-d')"
                        required
                    />
                </div>
                <x-form-submit />
            </form>
        </div>
    </x-tabler::modal>
</x-layouts.app>