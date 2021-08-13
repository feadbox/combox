<?php

namespace App\Models;

use App\Eloquent\Enums\UnitEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'unit',
    ];

    protected $casts = [
        'unit' => UnitEnum::class,
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(ProductTransaction::class);
    }
}
