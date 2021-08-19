<?php

namespace App\Eloquent\Enums;

use Feadbox\Support\Components\Enum;

final class AccountTypeEnum extends Enum
{
    const Safe = 1;
    const Account = 2;
    const Branch = 2;

    public static function getTitleAttribute($value): string
    {
        return match ($value) {
            self::Safe => 'Kasa',
            self::Account => 'Cari Hesap',
            self::Branch => 'Şube',
        };
    }
}
