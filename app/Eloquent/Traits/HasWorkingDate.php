<?php

namespace App\Eloquent\Traits;

use App\Models\UserWorkingDate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasWorkingDate
{
    public function workingDates(): HasMany
    {
        return $this->hasMany(UserWorkingDate::class);
    }

    public function currentWorkingDate(): HasOne
    {
        return $this->hasOne(UserWorkingDate::class)->ofMany(['start' => 'max'], function ($query) {
            $query->whereDate('start', '<=', today())->where(function ($query) {
                $query->whereNull('end')->orWhereDate('end', '>', today());
            });
        });
    }

    public function scopeCurrentlyWorking(Builder $query): Builder
    {
        return $query->whereHas('workingDates', function ($query) {
            $query->whereDate('start', '<=', today())->where(function ($query) {
                $query->whereNull('end')->orWhereDate('end', '>', today());
            });
        });
    }

    public function isCurrentlyWork(): bool
    {
        return $this->workingDates
            ->where('start', '<=', today())
            ->filter(function ($date) {
                return is_null($date->end) || $date->end > today();
            })
            ->isNotEmpty();
    }
}
