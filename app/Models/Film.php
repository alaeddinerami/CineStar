<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Film extends Model
{
    use HasFactory;

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function halls()
    {
        return $this->belongsToMany(Hall::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
