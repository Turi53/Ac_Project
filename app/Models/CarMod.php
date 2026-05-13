<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CarMod extends Model
{
    protected $fillable = [
        'model',
        'year_of_manufacture',
        'power',
        'torque',
        'zero_to_100',
        'weight',
        'top_speed',
        'make_id',
    ];

    public function Mod(): HasOne
    {
        return $this->HasOne(Mod::class);
    }
}
