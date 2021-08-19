<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Ürün oluştur" :back-route="route('products.index')" />
                <div class="page-body">
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-input
                                    label="Ürün adı"
                                    name="title"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Birim"
                                    name="unit"
                                    :options="$units"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Etiketler"
                                    name="tags[]"
                                    :options="$tags"
                                    multiple
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Cari Hesaplar"
                                    name="accounts[]"
                                    :options="$accounts"
                                    multiple
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