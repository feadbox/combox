<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Collection;

class DateService
{
    public function dates(): Collection
    {
        return collect(today()->subYear()->toPeriod(today(), '1 month'))
            ->mapWithKeys(function ($date) {
                return [$date->format('Y-m') => $date->translatedFormat('Y F')];
            })
            ->reverse();
    }

    public function selectedDate($date): Carbon
    {
        try {
            return Carbon::parse($date ?: today());
        } catch (InvalidFormatException) {
            return today();
        }
    }
}
