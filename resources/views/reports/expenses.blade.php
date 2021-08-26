<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Gider Raporu" />
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-body mb-3">
                                <h3 class="card-title">Cari borçları</h3>
                                <div class="card-subtitle">Anlık</div>
                                <div class="h1">{{ Money::format($accountExpenses) }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-body mb-3">
                                <h3 class="card-title">Personel borçları</h3>
                                <div class="card-subtitle">{{ $selectedDate->translatedFormat('F, Y') }}</div>
                                <div class="h1">{{ Money::format($employeeExpenses) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>