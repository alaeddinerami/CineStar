<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmHall;
use App\Models\Hall;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::all();
        $halls = Hall::all();
        $screenings = FilmHall::with('film', 'hall')->get();
        return view("dashboard.screenings.index", compact('films', 'halls', 'screenings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'film' => 'required',
            'hall' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $date = $validated['date'] . ' ' . $validated['time'];
        $date_now = Carbon::now()->floorHour()->toDateTimeString();
        if ($date_now >= $date) {
            return back()->with([
                'message' => 'You can\'t reserve a screening at this hour.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }
        if (FilmHall::where('hall_id', $validated['hall'])->where('date', $date)->exists()) {
            return back()->with([
                'message' => 'A film is already scheduled at this hour.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }

        FilmHall::create([
            'date' => $date,
            'hall_id' => $validated['hall'],
            'film_id' => $validated['film'],
        ]);

        return back()->with([
            'message' => 'Film screening reserved successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('dashboard.screenings.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
