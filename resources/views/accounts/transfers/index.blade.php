<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Para Transferi" :back-route="route('accounts.index')" />
                <div class="page-body">
                    <form action="{{ route('accounts.transfers.store') }}" method="post">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-select
                                    label="Gönderici"
                                    name="from"
                                    :options="$accounts"
                                    required
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Alıcı"
                                    name="to"
                                    :options="$accounts"
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>