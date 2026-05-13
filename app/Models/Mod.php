<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mod extends Model
{
    protected $fillable = [
        'mod_type',
        'description',
        'download_link',
        'is_premium',
        'author_id',
        'published_at'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
