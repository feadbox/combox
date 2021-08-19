<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Hesap oluştur" :back-route="route('accounts.index')" />
                <div class="page-body">
                    <form action="{{ route('accounts.store') }}" method="post">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-select
                                    label="Şube"
                                    name="branch"
                                    :options="$branches"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-input
                                    label="Hesap adı"
                                    name="name"
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