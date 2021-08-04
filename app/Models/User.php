<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(UserPayment::class);
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(UserSalary::class);
    }

    public function currentSalary(): HasOne
    {
        return $this->hasOne(UserSalary::class)->ofMany([
            'started_at' => 'max',
        ], function ($query) {
            $query->where('started_at', '<', now());
        });
    }

    public function vacations(): HasMany
    {
        return $this->hasMany(UserVacation::class);
    }

    public function workingDates(): HasMany
    {
        return $this->hasMany(UserWorkingDate::class);
    }

    public function currentWorkingDate(): HasOne
    {
        return $this->hasOne(UserWorkingDate::class)->ofMany([
            'started_at' => 'max',
        ], function ($query) {
            $query->where('started_at', '<', now());
        });
    }

    public function getFullNameAttribute(): string
    {
        return implode(' ', array_filter([$this->first_name, $this->last_name]));
    }

    public function scopeStillWorking(Builder $query): Builder
    {
        return $query->whereHas('workingDates', function ($query) {
            $query->whereDate('started_at', '<', now())->where(function ($query) {
                $query->whereNull('ended_at')->orWhereDate('ended_at', '>', now());
            });
        });
    }

    public function scopeSearch(Builder $query, $search): Builder
    {
        return $query->where('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%");
    }

    public function isStillWorking(): bool
    {
        return $this->workingDates
            ->where('started_at', '<', now())
            ->filter(function ($date) {
                return is_null($date->ended_at) || $date->ended_at > now();
            })
            ->isNotEmpty();
    }
}
