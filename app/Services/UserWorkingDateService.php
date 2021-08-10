<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class UserWorkingDateService
{
    public function period(User $user): Collection
    {
        $dates = collect();

        foreach ($user->workingDates as $workingDate) {
            $monthlyStartedAtPeriod = $workingDate->start->toPeriod(
                $workingDate->endedAtOrToday(),
                '1 month'
            );

            foreach ($monthlyStartedAtPeriod as $startedAt) {
                $dates->push(new UserSalaryService($user, $workingDate, $startedAt));
            }

            $startedAtNextMonthDoesntExists = $dates->filter(function ($date) use ($workingDate) {
                return $date->startedAt()->format('Y-m') === $workingDate->start->addMonth()->format('Y-m');
            })->count() === 0;

            if ($startedAtNextMonthDoesntExists && ($workingDate->ended_at && $workingDate->ended_at->isFuture())) {
                $dates->push(new UserSalaryService($user, $workingDate, $workingDate->start->addMonth()));
            }

            $endedAtMonthDoesntExists = $dates->filter(function ($date) use ($workingDate) {
                return $date->startedAt()->format('Y-m') === $workingDate->endedAtOrToday()->format('Y-m');
            })->count() === 0;

            if ($endedAtMonthDoesntExists) {
                $dates->push(new UserSalaryService($user, $workingDate, $workingDate->endedAtOrToday()));
            }
        }

        return $dates;
    }
}
