<?php

namespace App\Models;

use App\Eloquent\Enums\UnitEnum;
use Feadbox\Tags\Traits\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory, HasTags;

    protected $fillable = [
        'title',
        'unit',
    ];

    protected $casts = [
        'unit' => UnitEnum::class,
    ];

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class)->withTimestamps();
    }

    public function payments(): MorphMany
    {
        return $this->morphMany(AccountPayment::class, 'relation');
    }
}
