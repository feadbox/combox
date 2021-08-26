<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Hesap oluştur" :back-route="route('accounts.index')" />
                <div class="page-body">
                    <form action="{{ route('accounts.store') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-form-input
                                        label="Hesap adı"
                                        name="name"
                                        autofocus
                                    />
                                </div>
                                <x-form-select
                                    label="Hesap Türü"
                                    name="account_type"
                                    default="2"
                                    :options="[1 => 'Kasa', 2 => 'Cari Hesap']"
                                />
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-form-input
                                        label="Telefon numarası"
                                        name="phone"
                                    />
                                </div>
                                <x-form-input
                                    label="e-Posta adresi"
                                    name="email"
                                />
                            </div>
                            <div class="card-body">
                                <x-form-submit />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>