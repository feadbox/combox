<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$tag->name" :back-route="route('tags.index')">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Kalıcı olarak sil</button>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="card card-body">
                        <form action="{{ route('tags.update', $tag) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <x-form-input
                                    label="Pozisyon adı"
                                    name="name"
                                    :default="$tag->name"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Koleksiyon"
                                    name="collection"
                                    :options="['product' => 'Ürün', 'account-payment' => 'Hesap Ödemesi']"
                                    :default="$tag->collection"
                                />
                            </div>
                            <x-form-submit />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-tabler::modal-destroy id="modal-delete" :action="route('tags.destroy', $tag)" />
</x-layouts.app>