<?php

namespace App\Http\Controllers;

use App\Eloquent\Enums\PaymentTypeEnum;
use App\Http\Requests\StoreSalaryRequest;
use App\Models\Account;
use App\Models\AccountPayment;
use App\Models\User;
use App\Services\DateService;
use App\Services\UserSalaryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalaryController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        return view('salaries.index', [
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'dates' => $dateService->dates(),
            'paymentTypes' => PaymentTypeEnum::getAllTitles(),
            'users' => User::query()
                ->with('currentSalary')
                ->with(['workingDates' => fn ($query) => $query->byDate($selectedDate, 'Y-m')])
                ->withSum(['payments' => function ($query) use ($selectedDate) {
                    $query->whereMonth('salary_period', $selectedDate)->whereYear('salary_period', $selectedDate);
                }], 'price')
                ->whereHas('workingDates', fn ($query) => $query->byDate($selectedDate, 'Y-m'))
                ->get()
                ->map(function ($user) use ($selectedDate) {
                    $user->service = new UserSalaryService($user, $user->workingDates->first(), $selectedDate);

                    return $user;
                })
        ]);
    }

    public function store(StoreSalaryRequest $request): RedirectResponse
    {
        $user = User::find($request->user);

        $userPayment = $user->payments()->create($request->validated());

        $payment = new AccountPayment([
            'price' => -$request->price,
            'payment_date' => $request->payment_date,
        ]);

        $payment->account()->associate(Account::default()->first());
        $payment->branch()->associate($user->branch);
        $payment->relation()->associate($userPayment);

        $payment->save();

        return back();
    }
}
