<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <x-tabler::page-header :title="$account->name" :back-route="route('accounts.index', $account->forAccount() ? ['type' => 'account'] : ['type' => 'safe'])">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('accounts.edit', $account) }}" class="btn">Düzenle</a>
                            @if (!$account->forBranch() && !$account->is_default)
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
                                            label="Etiketler"
                                            name="tags"
                                            required
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <x-form-select
                                            label="Cari"
                                            name="relation"
                                            :options="$accounts"
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
                                            label="Tutar"
                                            name="price"
                                            required
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <x-form-input
                                            label="Tarih"
                                            type="date"
                                            name="payment_date"
                                            :default="today()->subDay()->format('Y-m-d')"
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
                                            <th>Cari</th>
                                            <th>Personel</th>
                                            <th>Etiketler</th>
                                            <th>Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td class="text-{{ $payment->price->cents() < 0 ? 'danger' : 'success' }}">{{ Money::format(abs($payment->price->cents())) }}</td>
                                                <td>
                                                    <span title="{{ $payment->description }}">{{ $payment->description ? Str::limit($payment->description, 200) : '-' }}</span>
                                                </td>
                                                <td>{{ $payment->branch->name ?? '-' }}</td>
                                                <td>
                                                    @if ($payment->relation instanceof App\Models\Account)
                                                        {{ $payment->relation->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($payment->relation instanceof App\Models\UserPayment)
                                                        {{ $payment->relation->user->full_name }}
                                                        ({{ $payment->relation->type->title }})
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach ($payment->tags as $tag)
                                                        <span class="tag">{{ $tag->name }}</span>
                                                    @endforeach
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
</x-layouts.app>