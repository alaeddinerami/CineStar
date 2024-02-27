<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmHall extends Model
{
    use HasFactory;

    protected $table = 'film_hall';

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
