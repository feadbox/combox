<?php

namespace App\Models;

use Feadbox\Support\Casts\MoneyCast;
use Feadbox\Tags\Traits\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AccountPayment extends Model
{
    use HasFactory, HasTags;

    protected $fillable = [
        'price',
        'description',
        'quantity',
        'payment_date',
        'period',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'period' => 'date',
        'price' => MoneyCast::class,
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
