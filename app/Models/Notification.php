<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function filmHall()
    {
        return $this->belongsTo(FilmHall::class, 'film_hall_id');
    }
}
