<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSafeRequest;
use App\Models\Branch;
use App\Models\Safe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SafeController extends Controller
{
    public function index(): View
    {
        return view('safes.index', [
            'safes' => Safe::paginate(),
        ]);
    }

    public function create(): View
    {
        return view('safes.create', [
            'branches' => Branch::pluck('name', 'id'),
        ]);
    }

    public function store(StoreSafeRequest $request): RedirectResponse
    {
        $safe = new Safe($request->only('name'));
        $safe->branch()->associate($request->branch);
        $safe->save();

        return redirect()->route('safes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
