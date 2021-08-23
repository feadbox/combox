<?php

namespace App\Http\Controllers;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Branch;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(Request $request): View
    {
        return view('accounts.index', [
            'accounts' => Account::query()
                ->withSum('payments', 'price')
                ->whereIn(
                    'account_type',
                    $request->type === 'account'
                        ? [AccountTypeEnum::Account]
                        : [AccountTypeEnum::Safe, AccountTypeEnum::Branch]
                )
                ->latest('is_default')
                ->latest('payments_sum_price')
                ->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('accounts.create', [
            'branches' => Branch::pluck('name', 'id'),
            'accountTypes' => AccountTypeEnum::getAllTitles(),
        ]);
    }

    public function store(StoreAccountRequest $request): RedirectResponse
    {
        Account::create($request->validated());

        return redirect()->route('accounts.index');
    }

    public function show(Account $account): View
    {
        $account->loadSum('payments', 'price');

        $payments = $account->payments()->latest()->paginate();
        $products = $account->products()->pluck('title', 'products.id');

        $branches = Branch::pluck('name', 'id');

        return view('accounts.show', compact(
            'account',
            'branches',
            'payments',
            'products'
        ));
    }

    public function edit(Account $account): View
    {
        $accountTypes = AccountTypeEnum::getAllTitles();

        return view('accounts.edit', compact('account', 'accountTypes'));
    }

    public function update(StoreAccountRequest $request, Account $account): RedirectResponse
    {
        $account->update($request->validated());

        return redirect()->route('accounts.show', $account);
    }

    public function destroy(Account $account): RedirectResponse
    {
        if ($account->forBranch() || $account->is_default) {
            return redirect()->route('accounts.index');
        }

        $account->delete();

        return redirect()->route('accounts.index');
    }
}
