<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Maaşlar" />
                <div class="page-body">
                    <div class="card card-table">
                        <div class="card-header">
                            <form class="w-full" action="{{ route('salaries.index') }}">
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
                                    <th>Çalışma günü</th>
                                    <th>Hakediş</th>
                                    <th>Ödeme</th>
                                    <th>Kalan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->service->paidDays() }}</td>
                                        <td>{{ Money::format($price = $user->service->price()) }}</td>
                                        <td>{{ Money::format($user->payments_sum_price) }}</td>
                                        <td>{{ Money::format($price - $user->payments_sum_price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>