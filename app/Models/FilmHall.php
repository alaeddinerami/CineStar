<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilmHall extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'film_hall';

    protected $casts = [
        'date' => 'datetime',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
