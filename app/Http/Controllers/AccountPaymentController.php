<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountPaymentRequest;
use App\Models\Account;
use Feadbox\Tags\Models\Tag;
use Illuminate\Http\RedirectResponse;

class AccountPaymentController extends Controller
{
    public function store(StoreAccountPaymentRequest $request, Account $account): RedirectResponse
    {
        $payment = $account->payments()->create($request->validated());

        $tags = explode(',', $request->tags);

        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag, 'collection' => 'account-payment']);

            $payment->tags()->attach($tag);
        }

        return redirect()->route('accounts.show', $account);
    }
}
