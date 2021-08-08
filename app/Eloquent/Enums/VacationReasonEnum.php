<?php

namespace App\Eloquent\Enums;

use Feadbox\Support\Components\Enum;

final class VacationReasonEnum extends Enum
{
    const Paid = 1;
    const Free = 2;
    const Annual = 3;

    public function getTitleAttribute($value): string
    {
        return match ($value) {
            self::Paid => 'Ücretli İzin',
            self::Free => 'Ücretsiz İzin',
            self::Annual => 'Yıllık İzin',
        };
    }

    public function getIsPaidAttribute($value): bool
    {
        return match ($value) {
            self::Paid => true,
            self::Free => false,
            self::Annual => true,
        };
    }

    public function getIsFreeAttribute(): bool
    {
        return !$this->isPaid;
    }
}
