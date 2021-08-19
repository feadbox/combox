<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$branch->name" :back-route="route('branches.index')">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Kalıcı olarak sil</button>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="card card-body">
                        <form action="{{ route('branches.update', $branch) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <x-form-input
                                    label="Şube adı"
                                    name="name"
                                    autofocus
                                    :default="$branch->name"
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
    <x-tabler::modal-destroy id="modal-delete" :action="route('branches.destroy', $branch)" />
</x-layouts.app>