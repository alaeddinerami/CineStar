<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\FilmHall;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Events\ReservationCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now()->floorHour()->toDateTimeString();
        
        $reservations = Reservation::where('user_id', Auth::id())->where('refunded', false)->where('screening_date', '>=', $now)->with(['seat.hall.films' => function ($query) {
            $query->withPivot('date');
        }])->paginate(5);
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($date, Hall $hall, Film $film)
    {
        $now = Carbon::now()->floorHour()->toDateTimeString();
        if ($now >= $date) {
            return abort('404');
        }
        if (!FilmHall::where('date', $date)->where('hall_id', $hall->id)->where('cancelled', false)->exists()) {
            return redirect()->back()->with([
                'message' => 'No such screening is reserved in this hall.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }
        $hall->load('seats.reservations');
        return view('reservations.create', compact('date', 'hall', 'film'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'seat_id' => 'required',
            'screening_date' => 'required',
        ]);

        if (Reservation::where('refunded', false)->where('screening_date', $validated['screening_date'])->where('seat_id', $validated['seat_id'])->exists()) {
            return redirect()->back()->with([
                'message' => 'This seat is already reserved.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }

        if (Reservation::where('user_id', Auth::id())->where('refunded', false)->where('screening_date', $validated['screening_date'])->exists()) {
            return redirect()->back()->with([
                'message' => 'You already reserved a seat on this screening date. Please check your reservations',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }
        $reservation = Reservation::create($validated);
        if ($reservation) {
            event(new ReservationCreated($reservation));
        }

        return redirect()->back()->with([
            'message' => 'Seat reserved successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            return abort('404');
        }
        $film = Film::where('slug', request()->route('film'))->firstOrFail();
        $reservation->load('seat.hall.films');
        return view('reservations.show', compact('reservation', 'film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
