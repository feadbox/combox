<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Çalışan ekle" :back-route="route('users.index')" />
                <div class="page-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-body mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <x-form-input
                                                    label="Ad"
                                                    name="first_name"
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <x-form-input
                                                    label="Soyad"
                                                    name="last_name"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <x-form-input
                                            label="Telefon numarası"
                                            name="phone"
                                        />
                                    </div>
                                    <x-form-input
                                        label="e-Posta adresi"
                                        name="email"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card card-body mb-3">
                                    <div class="mb-3">
                                        <x-form-input
                                            label="İşe başlama tarihi"
                                            type="date"
                                            name="started_at"
                                            :default="now()->toDateString()"
                                            required
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <x-form-select
                                            label="Şube"
                                            name="branch"
                                            :options="$branches"
                                            required
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <x-form-select
                                            label="Pozisyon"
                                            name="position"
                                            :options="$positions"
                                            required
                                        />
                                    </div>
                                    <x-form-input
                                        label="Maaş"
                                        name="salary"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <x-form-submit />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>