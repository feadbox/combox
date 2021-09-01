<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header :title="$position->name" :back-route="route('positions.index')">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Kalıcı olarak sil</button>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="card card-body">
                        <form action="{{ route('positions.update', $position) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <x-form-input
                                    label="Pozisyon adı"
                                    name="name"
                                    autofocus
                                    :default="$position->name"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-input
                                    label="Varsayılan maaş"
                                    name="default_price"
                                    :default="$position->default_price->withoutPrefix()"
                                />
                            </div>
                            <div class="mb-3">
                                <x-form-checkbox
                                    label="Tip hesabına dahil mi?"
                                    name="included_to_tip"
                                    :default="$position->included_to_tip"
                                />
                                <x-form-input
                                    label="Tip puanı"
                                    type="number"
                                    name="tip_point"
                                    :default="$position->tip_point"
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
    <x-tabler::modal-destroy id="modal-delete" :action="route('positions.destroy', $position)" />
</x-layouts.app>