<?php

namespace App\Models;

use App\Eloquent\Enums\VacationReasonEnum;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVacation extends Model
{
    use HasFactory, CastsEnums;

    protected $fillable = [
        'start',
        'end',
        'reason',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'reason' => VacationReasonEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
