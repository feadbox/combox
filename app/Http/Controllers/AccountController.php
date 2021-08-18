<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(Request $request): View
    {
        return view('accounts.index', [
            'accounts' => Account::where('name', 'like', "%{$request->q}%")->oldest('name')->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('accounts.create');
    }

    public function store(StoreAccountRequest $request): RedirectResponse
    {
        Account::create($request->validated());

        return redirect()->route('accounts.index');
    }

    public function show(Account $account): View
    {
        return view('accounts.show', compact('account'));
    }

    public function edit(Account $account): View
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(StoreAccountRequest $request, Account $account): RedirectResponse
    {
        $account->update($request->validated());

        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account): RedirectResponse
    {
        $account->delete();

        return redirect()->route('accounts.index');
    }
}
