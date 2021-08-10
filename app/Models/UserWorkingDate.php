<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class UserWorkingDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByDate(Builder $query, Carbon $date, string $format = 'Y-m-d'): Builder
    {
        $mysqlFormat = collect(explode('-', $format))
            ->map(fn ($str) => "%{$str}")
            ->implode('-');

        return $query
            ->where(DB::raw("Date_Format(`start`, '{$mysqlFormat}')"), '<=', $date->format($format))
            ->where(function ($query) use ($date, $format, $mysqlFormat) {
                $query
                    ->whereNull('end')
                    ->orWhere(DB::raw("Date_Format(`end`, '{$mysqlFormat}')"), '>=', $date->format($format));
            });
    }

    public function endedAtOrToday(): Carbon
    {
        return $this->end ?: today();
    }
}
