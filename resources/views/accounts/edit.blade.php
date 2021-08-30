<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$account->name" :back-route="route('accounts.show', $account)" />
                <div class="page-body">
                    <form action="{{ route('accounts.update', $account) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Genel</h3>
                                <div class="mb-3">
                                    <x-form-input
                                        label="Hesap adı"
                                        name="name"
                                        :default="$account->name"
                                        :readonly="$account->forBranch()"
                                        autofocus
                                    />
                                </div>
                                <x-form-select
                                    label="Hesap Türü"
                                    name="account_type"
                                    :default="$account->account_type"
                                    :options="$accountTypes"
                                />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Banka</h3>
                                <div class="mb-3">
                                    <x-form-input
                                        label="Hesap adı"
                                        name="bank_account_name"
                                        :default="$account->bank_account_name"
                                    />
                                </div>
                                <x-form-input
                                    label="IBAN"
                                    name="bank_account_iban"
                                    :default="$account->bank_account_iban"
                                />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">İletişim</h3>
                                <div class="mb-3">
                                    <x-form-input
                                        label="Telefon numarası"
                                        name="phone"
                                        :default="$account->phone"
                                    />
                                </div>
                                <x-form-input
                                    label="e-Posta adresi"
                                    name="email"
                                    :default="$account->email"
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