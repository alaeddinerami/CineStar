<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_hall');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
