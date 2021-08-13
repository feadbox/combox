<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'description',
    ];

    public function safe(): BelongsTo
    {
        return $this->belongsTo(Safe::class);
    }
}
