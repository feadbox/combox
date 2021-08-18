<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$account->name" :back-route="route('accounts.show', $account)" />
                <div class="page-body">
                    <div class="card card-body">
                        <form action="{{ route('accounts.update', $account) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <x-form-input
                                    label="Cari adı"
                                    name="name"
                                    :default="$account->name"
                                    required
                                    autofocus
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-input
                                    label="e-Posta adresi"
                                    name="email"
                                    :default="$account->email"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-input
                                    label="Telefon numarası"
                                    name="phone"
                                    :default="$account->phone"
                                />
                            </div>
                            <div>
                                <x-form-submit />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-tabler::modal-destroy id="modal-delete" :action="route('accounts.destroy', $account)" />
</x-layouts.app>