<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Branch;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        return view('accounts.index', [
            'accounts' => Account::withSum('payments', 'price')->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('accounts.create', [
            'branches' => Branch::pluck('name', 'id'),
        ]);
    }

    public function store(StoreAccountRequest $request): RedirectResponse
    {
        $account = new Account($request->only('name'));
        $account->branch()->associate($request->branch);
        $account->save();

        return redirect()->route('accounts.index');
    }

    public function show(Account $account): View
    {
        $account->loadSum('payments', 'price');

        $payments = $account->payments()->latest()->paginate();
        $products = $account->products()->pluck('title', 'products.id');

        return view('accounts.show', compact('account', 'payments', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
