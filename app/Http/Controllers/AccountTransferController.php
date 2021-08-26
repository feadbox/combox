<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountTransferRequest;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountTransferController extends Controller
{
    public function index(AccountService $accountService): View
    {
        return view('accounts.transfers.index', [
            'accounts' => $accountService->accountsByTypes(),
        ]);
    }

    public function store(StoreAccountTransferRequest $request): RedirectResponse
    {
        $from = Account::find($request->from);
        $to = Account::find($request->to);

        $from->payments()->create([
            'price' => -$request->price,
            'payment_date' => $request->payment_date,
            'description' => $description = "{$from->name} -> {$to->name}"
        ]);

        $to->payments()->create([
            'price' => $request->price,
            'payment_date' => $request->payment_date,
            'description' => $description,
        ]);

        return redirect()->route('accounts.transfers.index');
    }
}
