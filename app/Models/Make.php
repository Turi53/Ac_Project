<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Make extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function carMods(): HasMany
    {
        return $this->hasMany(CarMod::class);
    }
}
