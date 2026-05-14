<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Mod extends Model
{
    protected $fillable = [
        'description',
        'download_link',
        'is_premium',
        'author_id',
        'published_at'
    ];

    public function modable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
