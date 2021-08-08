<?php

namespace App\Eloquent\Activities;

use App\Models\Branch;
use Feadbox\Activities\Contracts\ActivityContract;

class UserBranchSavedActivity implements ActivityContract
{
    protected Branch $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    public function message(): string
    {
        return "Çalışanın şubesi **{$this->branch->name}** olarak kaydedildi.";
    }
}
