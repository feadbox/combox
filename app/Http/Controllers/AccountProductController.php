<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountProductRequest;
use App\Models\Account;
use App\Models\AccountPayment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class AccountProductController extends Controller
{
    public function store(StoreAccountProductRequest $request, Account $account): RedirectResponse
    {
        $product = Product::find($request->product);

        $payment = new AccountPayment([
            'price' => -$request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'payment_date' => $request->payment_date,
        ]);

        $payment->account()->associate($account);
        $payment->relation()->associate($product);
        $payment->save();

        return redirect()->route('accounts.show', $account);
    }
}
