<x-layouts.app>
    <x-slot name="scripts">
        <script>
            [...document.querySelectorAll('[data-bs-target="#modal-payment"]')].forEach(function (e) {
                e.addEventListener('click', function (button) {
                    var input = document.getElementById('modal-payment').querySelector('input[name=user]');
                    
                    input.value = button.target.dataset.id;
                });
            });
        </script>
    </x-slot>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Tip" />
                <div class="page-body">
                    <div class="card card-table">
                        <div class="card-header">
                            <form class="w-full" action="{{ route('tips.index') }}">
                                <x-form-select
                                    name="date"
                                    :options="$dates"
                                    :default="$selectedDate->format('Y-m')"
                                    onchange="this.parentElement.submit()"
                                />
                            </form>
                        </div>
                        <x-tabler::table>
                            <thead>
                                <tr>
                                    <th>Çalışan</th>
                                    <th>Çalıştığı gün sayısı</th>
                                    <th>Hakediş</th>
                                    <th>Ödenen</th>
                                    <th>Kalan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $days = $user->service->workingDays() }}</td>
                                        <td>{{ Money::format($tip = Money::convertToCents(floor(Money::convertFromCents($tipPriceByDays * $days)))) }}</td>
                                        <td>{{ Money::format($payed = $user->tip_payments_sum_price * -1) }}</td>
                                        <td>{{ Money::format($tip - $payed) }}</td>
                                        <td class="text-end">
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modal-payment" data-id="{{ $user->id }}">Ödeme yap</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-tabler::modal id="modal-payment">
        <x-tabler::modal-header title="Ödeme yap" />
        <div class="modal-body">
            <form action="{{ route('tips.store') }}" method="post">
                @csrf
                <input type="hidden" name="user">
                <div class="mb-3">
                    <x-form-select
                        label="Tip dönemi"
                        name="period"
                        :options="$dates"
                        :default="$selectedDate->format('Y-m')"
                        required
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
                        label="Ödeme tarihi"
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
    </x-tabler::modal>
</x-layouts.app>