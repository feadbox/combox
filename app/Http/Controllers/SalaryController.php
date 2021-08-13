<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserSalaryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalaryController extends Controller
{
    public function index(Request $request): View
    {
        $selectedDate = Carbon::parse($request->input('date', today()->format('Y-m')));
        $isSalaryDate = $selectedDate->isLastMonth() && today()->day >= 5;

        $dates = collect(today()->subYear()->toPeriod(today(), '1 month'))
            ->mapWithKeys(function ($date) {
                return [$date->format('Y-m') => $date->translatedFormat('Y F')];
            })
            ->reverse();

        $users = User::query()
            ->with(['workingDates' => fn ($query) => $query->byDate($selectedDate, 'Y-m')])
            ->withSum(['payments' => function ($query) use ($selectedDate) {
                $query->whereMonth('payment_date', $selectedDate)->whereYear('payment_date', $selectedDate);
            }], 'price')
            ->whereHas('workingDates', fn ($query) => $query->byDate($selectedDate, 'Y-m'))
            ->get()
            ->map(function ($user) use ($selectedDate) {
                $user->service = new UserSalaryService($user, $user->workingDates->first(), $selectedDate);

                return $user;
            });

        return view('salaries.index', compact(
            'selectedDate',
            'isSalaryDate',
            'dates',
            'users'
        ));
    }
}
