<?php

namespace App\Models;

use App\Eloquent\Enums\PaymentTypeEnum;
use Feadbox\Support\Casts\MoneyCast;
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
        'salary_period',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
        'type' => PaymentTypeEnum::class,
        'payment_date' => 'date',
        'salary_period' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
