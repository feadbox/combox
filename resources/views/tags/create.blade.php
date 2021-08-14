<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Etiket oluştur" :back-route="route('tags.index')" />
                <div class="page-body">
                    <form action="{{ route('tags.store') }}" method="post">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-input
                                    label="Etiket adı"
                                    name="name"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Koleksiyon"
                                    name="collection"
                                    :options="['product' => 'Ürün']"
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