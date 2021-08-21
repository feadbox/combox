<?php

namespace App\Http\Controllers;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Http\Requests\StoreBranchRequest;
use App\Models\Account;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(Request $request): View
    {
        return view('branches.index', [
            'branches' => Branch::where('name', 'like', "%{$request->q}%")->oldest('name')->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('branches.create');
    }

    public function store(StoreBranchRequest $request): RedirectResponse
    {
        $branch = Branch::create($request->validated());

        $account = new Account([
            'name' => $branch->name,
            'account_type' => AccountTypeEnum::Branch,
        ]);

        $account->accountable()->associate($branch);
        $account->save();

        return redirect()->route('branches.index');
    }

    public function edit(Branch $branch): View
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(StoreBranchRequest $request, Branch $branch): RedirectResponse
    {
        $branch->update($request->validated());

        return redirect()->route('branches.index');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        $branch->delete();
        $branch->account->delete();

        return redirect()->route('branches.index');
    }
}
