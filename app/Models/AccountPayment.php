<?php

namespace App\Models;

use Feadbox\Support\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AccountPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'description',
        'quantity',
        'payment_date',
    ];

    protected $casts = [
        'payment_date' => 'date',
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
}
