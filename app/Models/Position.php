<?php

namespace App\Models;

use Feadbox\Support\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'default_price',
        'included_to_tip',
    ];

    protected $casts = [
        'default_price' => MoneyCast::class,
        'included_to_tip' => 'boolean',
    ];
}
