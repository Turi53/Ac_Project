<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackMod extends Mod
{
    use HasFactory;

    public $timestamps = false;

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
