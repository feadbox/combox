<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserWorkingDateRequest;
use App\Models\User;

class UserWorkingDateController extends Controller
{
    public function update(UpdateUserWorkingDateRequest $request, User $user)
    {
        if (!$user->isCurrentlyWork() && $request->has('start')) {
            $user->workingDates()->create($request->validated());
        } else {
            $user->currentWorkingDate->update($request->validated());
        }

        return redirect()->route('users.show', $user);
    }
}
