<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DateService;
use App\Services\UserSalaryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalaryController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        return view('salaries.index', [
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'isSalaryDate' => $selectedDate->isLastMonth() && today()->day >= 5,
            'dates' => $dateService->dates(),
            'users' => User::query()
                ->with(['workingDates' => fn ($query) => $query->byDate($selectedDate, 'Y-m')])
                ->withSum(['payments' => function ($query) use ($selectedDate) {
                    $query->whereMonth('payment_date', $selectedDate)->whereYear('payment_date', $selectedDate);
                }], 'price')
                ->whereHas('workingDates', fn ($query) => $query->byDate($selectedDate, 'Y-m'))
                ->get()
                ->map(function ($user) use ($selectedDate) {
                    $user->service = new UserSalaryService($user, $user->workingDates->first(), $selectedDate);

                    return $user;
                })
        ]);
    }
}
