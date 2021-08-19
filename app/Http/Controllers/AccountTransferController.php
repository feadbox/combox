<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountTransferRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountTransferController extends Controller
{
    public function index(): View
    {
        return view('accounts.transfers.index', [
            'accounts' => Account::pluck('name', 'id'),
        ]);
    }

    public function store(StoreAccountTransferRequest $request): RedirectResponse
    {
        $from = Account::find($request->from);
        $to = Account::find($request->to);

        $from->payments()->create([
            'price' => -$request->price,
            'payment_date' => $request->payment_date,
        ]);

        $to->payments()->create([
            'price' => $request->price,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('accounts.transfers.index');
    }
}
