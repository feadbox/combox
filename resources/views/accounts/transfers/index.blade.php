<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Para Transferi" :back-route="route('accounts.index')" />
                <div class="page-body">
                    <form action="{{ route('accounts.transfers.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card card-body">
                                    <h3 class="card-title">Gönderici</h3>
                                    <x-form-select
                                        name="from"
                                        :options="$accounts"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-body">
                                    <div class="mb-3">
                                        <x-form-input
                                            label="Tutar"
                                            name="price"
                                            required
                                        />
                                    </div>
                                    <x-form-input
                                        label="Tarih"
                                        type="date"
                                        name="payment_date"
                                        :default="today()->format('Y-m-d')"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-body">
                                    <h3 class="card-title">Alıcı</h3>
                                    <x-form-select
                                        name="to"
                                        :options="$accounts"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <x-form-submit />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>