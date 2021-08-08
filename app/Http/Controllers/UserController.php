<?php

namespace App\Http\Controllers;

use App\Eloquent\Activities\UserBranchSavedActivity;
use App\Eloquent\Activities\UserCreatedActivity;
use App\Eloquent\Activities\UserPositionSavedActivity;
use App\Eloquent\Activities\UserSalarySavedActivity;
use App\Eloquent\Activities\UserWorkingStartedActivity;
use App\Http\Requests\StoreUserRequest;
use App\Models\Branch;
use App\Models\Position;
use App\Models\User;
use App\Services\UserWorkingDateService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->where(function ($query) use ($request) {
                filled($request->q) ? $query->search($request->q) : $query->stillWorking();
            })
            ->oldest('first_name')
            ->paginate();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        return view('users.create', [
            'branches' => Branch::oldest('name')->pluck('name', 'id'),
            'positions' => Position::query()
                ->select('id', 'name', 'default_price')
                ->oldest('name')
                ->get()
                ->mapWithKeys(function ($position) {
                    return [$position->id => "{$position->name} ($position->default_price)"];
                }),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $position = Position::select('id', 'name')->find($request->position);
        $branch = Branch::select('id', 'name')->find($request->branch);

        $user = new User($request->only(['first_name', 'last_name', 'email', 'phone']));
        $user->position()->associate($position);
        $user->branch()->associate($branch);
        $user->save();

        $workingDate = $user->workingDates()->create(['started_at' => $request->started_at]);

        $salary = $user->salaries()->create([
            'price' => $request->salary,
            'started_at' => $request->started_at,
        ]);

        $user->activity(new UserCreatedActivity);
        $user->activity(new UserBranchSavedActivity($branch));
        $user->activity(new UserPositionSavedActivity($position));
        $user->activity(new UserSalarySavedActivity($salary));
        $user->activity(new UserWorkingStartedActivity($workingDate));

        return redirect()->route('users.show', $user);
    }

    public function show(User $user, UserWorkingDateService $service): View
    {
        return view('users.show', [
            'user' => $user,
            'period' => $service->period($user),
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
