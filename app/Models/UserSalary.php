<?php

namespace App\Models;

use Feadbox\Support\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'started_at',
    ];

    protected $casts = [
        'started_at' => 'date',
        'price' => MoneyCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
