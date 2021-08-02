<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function vacations(): HasMany
    {
        return $this->hasMany(UserVacation::class);
    }

    public function workingDates(): HasMany
    {
        return $this->hasMany(UserWorkingDate::class);
    }
}
