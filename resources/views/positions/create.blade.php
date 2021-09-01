<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Pozisyon oluştur" :back-route="route('positions.index')" />
                <div class="page-body">
                    <form action="{{ route('positions.store') }}" method="post">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-input
                                    label="Pozisyon adı"
                                    name="name"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-input
                                    label="Varsayılan maaş"
                                    name="default_price"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-checkbox
                                    label="Tip hesabına dahil mi?"
                                    name="included_to_tip"
                                />
                                <x-form-input
                                    label="Tip puanı"
                                    type="number"
                                    name="tip_point"
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