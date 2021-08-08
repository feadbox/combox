<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserWorkingDate;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserSalaryService
{
    protected $vacations;

    protected $salary;

    protected $price;

    protected $paidDays;

    public function __construct(
        protected User $user,
        protected UserWorkingDate $workingDate,
        protected Carbon $startedAt
    ) {
        //
    }

    public function startedAt(): Carbon
    {
        return $this->startedAt;
    }

    public function workingDate(): UserWorkingDate
    {
        return $this->workingDate;
    }

    public function price(): float
    {
        $this->salary();

        return $this->price;
    }

    public function paidDays(): int
    {
        $this->salary();

        return $this->paidDays;
    }

    public function isStartOfWork(): bool
    {
        return $this->startedAt->isSameMonth($this->workingDate->started_at);
    }

    public function isEndOfWork(): bool
    {
        return $this->workingDate->ended_at && $this->startedAt->isSameMonth($this->workingDate->ended_at);
    }

    public function vacations(): Collection
    {
        if ($this->vacations) {
            return $this->vacations;
        }

        $vacations = $this->user->vacations()
            ->whereYear('started_at', $this->startedAt->year)
            ->whereMonth('started_at', $this->startedAt->month)
            ->get();

        $collection = collect();

        foreach ($vacations as $vacation) {
            if ($vacation->ended_at) {
                foreach ($vacation->started_at->toPeriod($vacation->ended_at, '1 day') as $startedAt) {
                    $collection->push([
                        'started_at' => $startedAt,
                        'reason_title' => $vacation->reason->title,
                        'reason_is_free' => $vacation->reason->isFree,
                    ]);
                }

                continue;
            }

            $collection->push([
                'started_at' => $vacation->started_at,
                'reason_title' => $vacation->reason->title,
                'reason_is_free' => $vacation->reason->isFree,
            ]);
        }

        return $this->vacations = $collection->filter(function ($vacation) {
            return $vacation['started_at']->month === $this->startedAt->month
                && $vacation['started_at']->year === $this->startedAt->year;
        });
    }

    protected function salary(): void
    {
        if ($this->price) {
            return;
        }

        $paidDays = 30;

        if ($this->startedAt->isCurrentMonth()) {
            if ($this->isEndOfWork()) {
                $paidDays = $this->workingDate->ended_at->day;
            } else {
                $paidDays = today()->subDay()->day;
            }
        }

        if ($this->isStartOfWork()) {
            $paidDays++;
            $paidDays -= $this->workingDate->started_at->day;
        }

        if (!$this->startedAt->isCurrentMonth() && $this->isEndOfWork()) {
            $paidDays -= 30 - $this->workingDate->ended_at->day;
        }

        foreach ($this->vacations() as $vacation) {
            if ($vacation['reason_is_free']) {
                $paidDays--;
            }
        }

        if ($paidDays > 30) {
            $paidDays = 30;
        }

        $this->paidDays = $paidDays;
        $this->price = ($this->user->currentSalary->price->cents() / 30) * $paidDays;
    }
}
