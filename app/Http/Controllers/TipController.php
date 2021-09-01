<?php

namespace App\Http\Controllers;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipRequest;
use App\Models\Account;
use App\Models\AccountPayment;
use App\Models\Position;
use App\Models\User;
use App\Services\DateService;
use App\Services\UserSalaryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TipController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        $selectedDate = $dateService->selectedDate($request->date);

        $tipAccount = Account::query()
            ->tip()
            ->withSum(['payments' => function ($query) use ($selectedDate) {
                $query
                    ->where('price', '>', 0)
                    ->whereMonth('period', $selectedDate)
                    ->whereYear('period', $selectedDate);
            }], 'price')
            ->first();

        $users = User::query()
            ->with([
                'workingDates' => fn ($query) => $query->byDate($selectedDate, 'Y-m'),
                'position:id,tip_point'
            ])
            ->withSum(['tipPayments' => function ($query) use ($selectedDate) {
                $query->whereMonth('period', $selectedDate)->whereYear('period', $selectedDate);
            }], 'price')
            ->whereHas('workingDates', fn ($query) => $query->byDate($selectedDate, 'Y-m'))
            ->whereIn('position_id', Position::where('included_to_tip', true)->pluck('id'))
            ->get()
            ->filter(fn ($user) => $user->salaryService($selectedDate)->paidDays() >= 15);

        $totalDays = $users->map->salaryService($selectedDate)->sum->paidDays() + $users->map->position->sum->tip_point;

        return view('tips.index', [
            'selectedDate' => $selectedDate,
            'dates' => $dateService->dates(),
            'users' => $users,
            'tipPriceByDays' => $totalDays === 0 ? 0 : ($tipAccount->payments_sum_price / $totalDays),
        ]);
    }

    public function store(StoreTipRequest $request): RedirectResponse
    {
        $payment = new AccountPayment([
            'price' => -$request->price,
            'period' => $request->period,
            'payment_date' => $request->payment_date,
        ]);

        $payment->account()->associate(Account::tip()->first());
        $payment->relation()->associate($user = User::find($request->user));
        $payment->branch()->associate($user->branch);

        $payment->save();

        $payment->tag('TIP', 'account-payment');

        return back();
    }
}
