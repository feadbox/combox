<?php

namespace App\Models;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Eloquent\Traits\HasWorkingDate;
use App\Services\UserSalaryService;
use Carbon\Carbon;
use Feadbox\Activities\Eloquent\Traits\HasActivities;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasActivities, HasWorkingDate;

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

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(UserPayment::class);
    }

    public function tipPayments(): MorphMany
    {
        return $this->morphMany(AccountPayment::class, 'relation')
            ->whereHas('account', function (Builder $query) {
                $query->where('account_type', AccountTypeEnum::Tip);
            });
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(UserSalary::class);
    }

    public function currentSalary(): HasOne
    {
        return $this->hasOne(UserSalary::class)->ofMany(
            ['start' => 'max'],
            fn ($query) => $query->where('start', '<', now())
        );
    }

    public function vacations(): HasMany
    {
        return $this->hasMany(UserVacation::class);
    }

    public function getFullNameAttribute(): string
    {
        return implode(' ', array_filter([$this->first_name, $this->last_name]));
    }

    public function scopeSearch(Builder $query, $search): Builder
    {
        return $query->where('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%");
    }

    public function salaryService(Carbon $selectedDate): UserSalaryService
    {
        return new UserSalaryService($this, $this->workingDates->first(), $selectedDate);
    }
}
