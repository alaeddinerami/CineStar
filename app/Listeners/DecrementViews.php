<?php

namespace App\Listeners;

use App\Models\FilmHall;
use App\Events\ReservationRefunded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecrementViews
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
    public function handle(ReservationRefunded $ReservationRefunded): void
    {
        $hall = $ReservationRefunded->reservation->seat->hall;
        $screening = FilmHall::where('hall_id', $hall->id)->where('date', $ReservationRefunded->reservation->screening_date)->first();
        if ($screening) {
            $screening->decrement('views');
        }
    }
}
