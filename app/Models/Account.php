<?php

namespace App\Models;

use App\Eloquent\Enums\AccountTypeEnum;
use Illuminate\Database\Eloquent\Builder;
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
        'bank_account_name',
        'bank_account_iban',
        'account_type',
        'is_default',
    ];

    protected $casts = [
        'account_type' => AccountTypeEnum::class,
        'is_default' => 'boolean',
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

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public function total(): int
    {
        return $this->payments_sum_price ?: 0;
    }

    public function isDebt(): bool
    {
        return $this->total() < 0;
    }

    public function forBranch(): bool
    {
        return $this->account_type->is(AccountTypeEnum::Branch);
    }

    public function forAccount(): bool
    {
        return $this->account_type->is(AccountTypeEnum::Account);
    }

    public function forSafe(): bool
    {
        return $this->account_type->is(AccountTypeEnum::Safe);
    }
}
