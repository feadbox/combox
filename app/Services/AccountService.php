<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Collection;

class AccountService
{
    public function accountsByTypes(): Collection
    {
        return Account::query()
            ->select('id', 'name', 'account_type')
            ->get()
            ->groupBy(fn ($account) => $account->account_type->plural_title)
            ->map(fn ($group) => $group->pluck('name', 'id'));
    }
}
