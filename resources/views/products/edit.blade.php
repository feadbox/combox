<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$product->title" :back-route="route('products.index')" />
                <div class="page-body">
                    <form action="{{ route('products.update', $product) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-input
                                    label="Ürün adı"
                                    name="title"
                                    :default="$product->title"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Birim"
                                    name="unit"
                                    :options="$units"
                                    :default="$product->unit"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-select
                                    label="Etiketler"
                                    name="tags[]"
                                    :options="$tags"
                                    :default="$product->tags->pluck('id')"
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