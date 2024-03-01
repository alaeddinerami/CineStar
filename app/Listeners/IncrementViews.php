<?php

namespace App\Listeners;

use App\Models\FilmHall;
use App\Models\Reservation;
use App\Events\ReservationCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementViews
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationCreated $ReservationCreated): void
    {
        $hall = $ReservationCreated->reservation->seat->hall;
        $screening = FilmHall::where('hall_id', $hall->id)->where('date', $ReservationCreated->reservation->screening_date)->first();
        if ($screening) {
            $screening->increment('views');
        }
    }
}
