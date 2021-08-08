<?php

namespace App\Eloquent\Activities;

use App\Models\UserSalary;
use Feadbox\Activities\Contracts\ActivityContract;

class UserSalarySavedActivity implements ActivityContract
{
    protected UserSalary $salary;

    public function __construct(UserSalary $salary)
    {
        $this->salary = $salary;
    }

    public function message(): string
    {
        return "Çalışanın maaşı **{$this->salary->price}** olarak kaydedildi.";
    }
}
