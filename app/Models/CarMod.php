<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarMod extends Model
{
    use HasFactory;

    public $timestamps = false;

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

    public function mod(): MorphOne
    {
        return $this->morphOne(Mod::class, 'modable');
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class);
    }
}
