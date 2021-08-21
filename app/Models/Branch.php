<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function account(): MorphOne
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function accountPayments(): HasMany
    {
        return $this->hasMany(AccountPayment::class);
    }
}
