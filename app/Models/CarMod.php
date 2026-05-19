<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CarMod extends Model
{
    use HasFactory, HasSlug;

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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fn (CarMod $carMod) => "{$carMod->make->name} {$carMod->model}")
            ->saveSlugsTo('slug');
    }
}
