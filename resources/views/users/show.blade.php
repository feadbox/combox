<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <x-tabler::page-header :title="$user->full_name" :back-route="route('users.index')">
                    <x-slot name="actions">
                        <div class="btn-list">
                            <a href="{{ route('users.edit', $user) }}" class="btn">Düzenle</a>
                        </div>
                    </x-slot>
                </x-tabler::page-header>
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <div class="text-uppercase small font-weight-bold">Mevcut maaş</div>
                                    <div class="h2 mt-2">{{ $user->currentSalary->price }}</div>
                                </div>
                                <div class="card-body text-center border-bottom">
                                    <div class="text-uppercase small font-weight-bold">İşe başlama tarihi</div>
                                    <div class="h3 mt-2">{{ $user->currentWorkingDate->started_at->translatedFormat('j F l, Y') }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="card-body text-center border-end">
                                            <div class="text-uppercase small font-weight-bold">Şube</div>
                                            <div class="h3 mt-2">{{ $user->branch->name }}</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card-body text-center">
                                            <div class="text-uppercase small font-weight-bold">Pozisyon</div>
                                            <div class="h3 mt-2">{{ $user->position->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-0">
                                @foreach ($user->latestActivities as $activity)
                                    <div class="card card-body mb-3">
                                        <p class="text-muted small mb-2">{{ $activity->created_at->translatedFormat('Y j F l H:i:s') }}</p>
                                        {{ $activity->message_markdown }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-5">
                            @foreach ($period as $salaryService)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $salaryService->startedAt()->translatedFormat('F, Y') }}</h3>
                                    </div>
                                    <div class="card-table table-responsive">
                                        <table class="table">
                                            <tbody>
                                                @if ($salaryService->isStartOfWork())
                                                    <tr>
                                                        <td>
                                                            <span class="text-success">İşe başladı</span>
                                                        </td>
                                                        <td class="text-end">{{ $salaryService->startedAt()->day }}</td>
                                                    </tr>
                                                @endif
                                                @foreach ($salaryService->vacations() as $vacation)
                                                    <tr>
                                                        <td>{{ $vacation['reason_title'] }}</td>
                                                        <td class="text-end">{{ $vacation['started_at']->format('j') }}</td>
                                                    </tr>
                                                @endforeach
                                                @if ($salaryService->isEndOfWork())
                                                    <tr>
                                                        <td>
                                                            <span class="text-danger">İşten ayrıldı</span>
                                                        </td>
                                                        <td class="text-end">{{ $salaryService->workingDate()->ended_at->day }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>Hakediş</td>
                                                    <td class="text-end">
                                                        <strong>{{ Money::format($salaryService->price()) }} ({{ $salaryService->paidDays() }} gün)</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>