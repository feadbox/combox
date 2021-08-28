<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountPaymentRequest;
use App\Models\Account;
use App\Models\AccountPayment;
use Feadbox\Tags\Models\Tag;
use Illuminate\Http\RedirectResponse;

class AccountPaymentController extends Controller
{
    public function store(StoreAccountPaymentRequest $request, Account $account): RedirectResponse
    {
        $payment = new AccountPayment($request->validated());
        $payment->account()->associate($account);

        if ($request->relation) {
            $payment->relation()->associate(Account::find($request->relation));
        }

        $payment->save();

        $tags = json_decode($request->tags);

        foreach ($tags as $tag) {
            $savedTag = Tag::firstOrCreate([
                'name' => $tag->value,
                'collection' => 'account-payment'
            ]);

            $payment->tags()->attach($savedTag);
        }

        return redirect()->route('accounts.show', $account);
    }
}
