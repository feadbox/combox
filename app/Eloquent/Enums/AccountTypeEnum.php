<?php

namespace App\Eloquent\Enums;

use Feadbox\Support\Components\Enum;

final class AccountTypeEnum extends Enum
{
    const Safe = 1;
    const Account = 2;
    const Branch = 3;
    const Employee = 4;

    public static function getTitleAttribute($value): string
    {
        return match ($value) {
            self::Safe => 'Kasa',
            self::Account => 'Cari Hesap',
            self::Branch => 'Şube',
            self::Employee => 'Personel',
        };
    }

    public static function getPluralTitleAttribute($value): string
    {
        return match ($value) {
            self::Safe => 'Kasalar',
            self::Account => 'Cari Hesaplar',
            self::Branch => 'Şubeler',
            self::Employee => 'Personeller',
        };
    }
}
