<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserVacationRequest;
use App\Models\User;

class UserVacationController extends Controller
{
    public function store(StoreUserVacationRequest $request, User $user)
    {
        $user->vacations()->create($request->validated());

        return redirect()->route('users.show', $user);
    }
}
