<?php

namespace App\Models;

use App\Eloquent\Enums\AccountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'account_type',
    ];

    protected $casts = [
        'account_type' => AccountTypeEnum::class,
    ];

    public function accountable(): MorphTo
    {
        return $this->morphTo();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(AccountPayment::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function total(): int
    {
        return $this->payments_sum_price ?: 0;
    }

    public function isDebt(): bool
    {
        return $this->total() < 0;
    }
}
