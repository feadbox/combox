<?php

namespace App\Http\Controllers\Reports;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountPayment;
use App\Models\User;
use App\Models\UserPayment;
use App\Services\DateService;
use App\Services\UserSalaryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        return view('reports.expenses', [
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'accountExpenses' => AccountPayment::query()
                ->whereHas('account', function ($query) {
                    $query->where('account_type', AccountTypeEnum::Account);
                })
                ->sum('price') * -1,
            'employeeExpenses' => User::query()
                ->with(['workingDates' => fn ($query) => $query->byDate($selectedDate, 'Y-m')])
                ->withSum(['payments' => function ($query) use ($selectedDate) {
                    $query->whereMonth('salary_period', $selectedDate)->whereYear('salary_period', $selectedDate);
                }], 'price')
                ->whereHas('workingDates', fn ($query) => $query->byDate($selectedDate, 'Y-m'))
                ->get()
                ->map(function ($user) use ($selectedDate) {
                    $service = new UserSalaryService($user, $user->workingDates->first(), $selectedDate);

                    return $service->price() - $user->payments->map(fn ($payment) => $payment->price->cents())->sum();
                })
                ->sum(),
        ]);
    }
}
