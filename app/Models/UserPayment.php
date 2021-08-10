<?php

namespace App\Models;

use App\Eloquent\Enums\PaymentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'type',
        'payment_date',
    ];

    protected $casts = [
        'type' => PaymentTypeEnum::class,
        'payment_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
