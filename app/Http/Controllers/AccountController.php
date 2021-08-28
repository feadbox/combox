<?php

namespace App\Http\Controllers;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Branch;
use App\Models\Account;
use Feadbox\Tags\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(Request $request): View
    {
        $type = (int) $request->input('type', 1);

        return view('accounts.index', [
            'title' => AccountTypeEnum::fromValue($type)->plural_title,
            'accounts' => Account::query()
                ->withSum('payments', 'price')
                ->where('account_type', $type)
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
        $account = Account::create($request->validated());

        return redirect()->route('accounts.show', $account);
    }

    public function show(Account $account): View
    {
        $account->loadSum('payments', 'price');

        $payments = $account->payments()->latest()->paginate();
        $products = $account->products()->pluck('title', 'products.id');

        $branches = Branch::pluck('name', 'id');
        $accounts = Account::where('account_type', AccountTypeEnum::Account)->pluck('name', 'id');

        $tags = Tag::where('collection', 'account-payment')->pluck('name');

        return view('accounts.show', compact(
            'account',
            'branches',
            'accounts',
            'payments',
            'products',
            'tags'
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
