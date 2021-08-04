<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header :title="$user->full_name" :back-route="route('users.index')" />
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-8">
                            @foreach ($dates as $date)
                                <div class="card card-body mb-3">
                                    <h3 class="card-title">{{ $date->translatedFormat('F, Y') }}</h3>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="text-uppercase small font-weight-bold">Mevcut Maaş</div>
                                    <div class="h2 mt-2">{{ Money::format($user->currentSalary->price) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>