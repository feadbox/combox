<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$account->name" :back-route="route('accounts.show', $account)" />
                <div class="page-body">
                    <form action="{{ route('accounts.update', $account) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-input
                                    label="Hesap adı"
                                    name="name"
                                    :default="$account->name"
                                    :readonly="$account->forBranch()"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Hesap Türü"
                                    name="account_type"
                                    :default="$account->account_type"
                                    :options="$accountTypes"
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