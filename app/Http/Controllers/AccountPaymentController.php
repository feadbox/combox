<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountPaymentRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;

class AccountPaymentController extends Controller
{
    public function store(StoreAccountPaymentRequest $request, Account $account): RedirectResponse
    {
        $account->payments()->create($request->validated());

        return redirect()->route('accounts.show', $account);
    }
}
