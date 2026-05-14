<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

class TrackMod extends Mod
{
    protected $fillable = [
        'name',
        'distance',
        'number_of_pits',
        'country',
        'city',
    ];

    public function mod(): MorphOne
    {
        return $this->morphOne(Mod::class, 'modable');
    }
}
