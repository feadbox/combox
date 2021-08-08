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
        'started_at',
        'ended_at',
        'reason',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'reason' => VacationReasonEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
