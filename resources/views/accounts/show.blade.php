<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$account->name" :back-route="route('accounts.index')">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('accounts.edit', $account) }}" class="btn">Düzenle</a>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Kalıcı olarak sil</button>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="card card-body">
                        selam
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-tabler::modal-destroy id="modal-delete" :action="route('accounts.destroy', $account)" />
</x-layouts.app>