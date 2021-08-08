<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <x-tabler::page-header title="Şube oluştur" :back-route="route('branches.index')" />
                <div class="page-body">
                    <form action="{{ route('branches.store') }}" method="post">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-3">
                                <x-form-input
                                    label="Şube adı"
                                    name="name"
                                />
                            </div>
                            <x-form-submit />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>