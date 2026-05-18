<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mod extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'download_link',
        'is_premium',
        'author_id',
        'published_at',
        'status',
        'modable_type',
        'modable_id'
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
