<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DatePivot extends Pivot
{
    protected $casts = [
        'date' => 'datetime'
    ];
}
