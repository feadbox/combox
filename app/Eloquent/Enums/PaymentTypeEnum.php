<?php

namespace App\Eloquent\Enums;

use Feadbox\Support\Components\Enum;

final class PaymentTypeEnum extends Enum
{
    const Advance = 1;
    const Salary = 2;

    public function getTitleAttribute($value): string
    {
        return match ($value) {
            self::Advance => 'Avans',
            self::Salary => 'Maaş',
        };
    }
}
