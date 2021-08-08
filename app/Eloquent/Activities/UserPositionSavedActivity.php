<?php

namespace App\Eloquent\Activities;

use App\Models\Position;
use Feadbox\Activities\Contracts\ActivityContract;

class UserPositionSavedActivity implements ActivityContract
{
    protected Position $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function message(): string
    {
        return "Çalışanın pozisyonu **{$this->position->name}** olarak kaydedildi.";
    }
}
