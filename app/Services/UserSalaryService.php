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

    protected $workingDays;

    protected bool $calculated = false;

    public function __construct(
        protected User $user,
        protected UserWorkingDate $workingDate,
        protected Carbon $period
    ) {
        //
    }

    public function period(): Carbon
    {
        return $this->period;
    }

    public function workingDate(): UserWorkingDate
    {
        return $this->workingDate;
    }

    public function price(): float
    {
        $this->calculateDays();

        return $this->price;
    }

    public function paidDays(): int
    {
        $this->calculateDays();

        return $this->paidDays;
    }

    public function workingDays(): int
    {
        $this->calculateDays();

        return $this->workingDays;
    }

    public function isStartOfWork(): bool
    {
        return $this->period->isSameMonth($this->workingDate->start);
    }

    public function isEndOfWork(): bool
    {
        return $this->workingDate->end && $this->period->isSameMonth($this->workingDate->end);
    }

    public function vacations(): Collection
    {
        if ($this->vacations) {
            return $this->vacations;
        }

        $vacations = $this->user->vacations()
            ->whereYear('start', $this->period->year)
            ->whereMonth('start', $this->period->month)
            ->get();

        $collection = collect();

        foreach ($vacations as $vacation) {
            if ($vacation->end) {
                foreach ($vacation->start->toPeriod($vacation->end, '1 day') as $period) {
                    $collection->push([
                        'start' => $period,
                        'reason_title' => $vacation->reason->title,
                        'reason_is_free' => !$vacation->reason->isPaid,
                    ]);
                }

                continue;
            }

            $collection->push([
                'start' => $vacation->start,
                'reason_title' => $vacation->reason->title,
                'reason_is_free' => !$vacation->reason->isPaid,
            ]);
        }

        return $this->vacations = $collection->filter(function ($vacation) {
            return $vacation['start']->month === $this->period->month
                && $vacation['start']->year === $this->period->year;
        });
    }

    protected function calculateDays(): void
    {
        if ($this->calculated) {
            return;
        }

        $paidDays = 30;

        if ($this->isEndOfWork()) {
            $lastDay = $this->workingDate->end->day > 30 ? 30 : $this->workingDate->end->day;
        } else if ($this->period->isCurrentMonth()) {
            $paidDays = !($subDay = today()->subDay())->isLastMonth() ? $subDay->day : 0;
        } else if ($this->isStartOfWork()) {
            $paidDays = $this->workingDate->start->lastOfMonth()->day;
        }

        if ($this->isStartOfWork() && $this->isEndOfWork()) {
            $paidDays = $this->workingDate->start->diffInDays($this->workingDate->end) + 1;
        } else if ($this->isEndOfWork()) {
            $paidDays = $lastDay;
        } else if ($this->isStartOfWork()) {
            $paidDays -= $this->period->day - 1;
        }

        $workingDays = $paidDays;

        foreach ($this->vacations() as $vacation) {
            if ($vacation['reason_is_free']) {
                $paidDays--;
            }

            $workingDays--;
        }

        if ($paidDays < 0) {
            $paidDays = 0;
        }

        if ($paidDays > 30) {
            $paidDays = 30;
        }

        if ($workingDays < 0) {
            $workingDays = 0;
        }

        if ($workingDays > 30) {
            $workingDays = 30;
        }

        $this->paidDays = $paidDays;
        $this->workingDays = $workingDays;
        $this->price = ($this->user->currentSalary->price->cents() / 30) * $paidDays;

        $this->calculated = true;
    }
}
