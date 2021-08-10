<?php

namespace App\Eloquent\Activities;

use App\Models\UserWorkingDate;
use Feadbox\Activities\Contracts\ActivityContract;

class UserWorkingStartedActivity implements ActivityContract
{
    protected UserWorkingDate $date;

    public function __construct(UserWorkingDate $date)
    {
        $this->date = $date;
    }

    public function message(): string
    {
        $date = $this->date->start->translatedFormat('j F l Y');

        return "Çalışanın işe başlama tarihi **{$date}** olarak kaydedildi.";
    }
}
