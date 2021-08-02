<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header title="Çalışanlar" />
                <div class="page-body">
                    <div class="card card-table">
                        <div class="card-header">
                            <div class="w-100">
                                <div class="text-muted mb-2">
                                    <strong>{{ $users->total() }}</strong> kayıtlı çalışan
                                </div>
                                <x-tabler::table-search />
                            </div>
                        </div>
                        <x-tabler::table>
                            <thead>
                                <tr>
                                    <th>Çalışan</th>
                                    <th>Telefon numarası</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{ route('users.show', $user) }}">{{ $user->full_name }}</a>
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tabler::table>
                    </div>
                    <x-tabler::paginate :links="$users->links()" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>