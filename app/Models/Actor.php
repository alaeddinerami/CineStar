<?php

namespace App\Models;

use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Actor extends Model
{
    use HasFactory , ImageUpload;
    protected $fillable = ['name'] ;
    protected $with = ['image'] ;

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
