<?php

namespace App\Eloquent\Enums;

use Feadbox\Support\Components\Enum;

final class AccountTypeEnum extends Enum
{
    const Safe = 1;
    const Account = 2;
    const Branch = 3;
    const Employee = 4;
    const Tip = 5;

    public static function getTitleAttribute($value): string
    {
        return match ($value) {
            self::Safe => 'Kasa',
            self::Account => 'Cari Hesap',
            self::Branch => 'Şube',
            self::Employee => 'Personel',
            self::Tip => 'Bahşiş',
        };
    }

    public static function getPluralTitleAttribute($value): string
    {
        return match ($value) {
            self::Safe => 'Kasalar',
            self::Account => 'Cari Hesaplar',
            self::Branch => 'Şube Hesapları',
            self::Employee => 'Personel Hesapları',
            self::Tip => 'Bahşiş Hesapları',
        };
    }
}
