<?php

namespace App\Eloquent\Activities;

use Feadbox\Activities\Contracts\ActivityContract;

class UserCreatedActivity implements ActivityContract
{
    public function message(): string
    {
        return "Çalışan oluşturuldu.";
    }
}
