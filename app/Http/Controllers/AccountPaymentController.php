<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountPaymentRequest;
use App\Models\Account;
use App\Models\AccountPayment;
use Illuminate\Http\RedirectResponse;

class AccountPaymentController extends Controller
{
    public function store(StoreAccountPaymentRequest $request, Account $account): RedirectResponse
    {
        $payment = new AccountPayment($request->validated() + [
            'period' => $request->payment_date,
        ]);

        $payment->account()->associate($account);

        if ($request->relation) {
            $payment->relation()->associate(Account::find($request->relation));
        }

        $payment->save();

        $tags = json_decode($request->tags);

        foreach ($tags as $tag) {
            $payment->tag($tag->value, 'account-payment');
        }

        return redirect()->route('accounts.show', $account);
    }
}
