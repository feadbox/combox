<?php

namespace App\Eloquent\Enums;

use Feadbox\Support\Components\Enum;

class UnitEnum extends Enum
{
    const KG = 1;
    const Piece = 2;

    public static function getTitleAttribute($value): string
    {
        return match ($value) {
            self::KG => 'KG',
            self::Piece => 'Adet',
        };
    }
}
