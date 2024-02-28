<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $halls = Hall::all();
        return view('dashboard.halls.index', compact('halls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'name' => ['required'],
            'seats' => ['required'],
        ]);

        if (Hall::where('name', $validated['name'])->exists()) {
            return back()->with([
                'message' => 'Another hall name already exists with this name.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }

        $hall = Hall::create($validated);

        for ($i = 0; $i < $hall->seats; $i++) {
            Seat::create([
                'hall_id' => $hall->id,
            ]);
        }
        return back()->with([
            'message' => 'Hall created successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hall $hall)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'seats' => ['required'],
        ]);
        if (Hall::where('name', $validated['name'])->where('id', '!=', $hall->id)->exists()) {
            return back()->with([
                'message' => 'Another hall name already exists with this name.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }
        if ($hall->films()->count() > 0) {
            return back()->with([
                'message' => 'You can\'t modify the hall seats numbers when its reserved for a screening.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }

        $hall->update($validated);
        return back()->with([
            'message' => 'Hall updated successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        if ($hall->films()->count() > 0) {
            return back()->with([
                'message' => 'You can\'t delete the hall when its reserved for a screening.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }

        $hall->delete();

        return back()->with([
            'message' => 'Hall deleted successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }
}
