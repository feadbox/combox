<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index(Request $request): View
    {
        return view('positions.index', [
            'positions' => Position::where('name', 'like', "%{$request->q}%")->oldest('name')->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('positions.create');
    }

    public function store(StorePositionRequest $request): RedirectResponse
    {
        Position::create($request->validated());

        return redirect()->route('positions.index');
    }

    public function edit(Position $position): View
    {
        return view('positions.edit', compact('position'));
    }

    public function update(StorePositionRequest $request, Position $position): RedirectResponse
    {
        $position->update($request->validated() + [
            'included_to_tip' => $request->included_to_tip === '1',
        ]);

        return redirect()->route('positions.index');
    }

    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();

        return redirect()->route('positions.index');
    }
}
