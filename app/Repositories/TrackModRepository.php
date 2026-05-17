<?php

namespace App\Repositories;

use App\Models\TrackMod;

class TrackModRepository
{
    public function getPublished(int $resultsPerPage = 9)
    {
        return TrackMod::join('mods', 'track_mods.id', '=', 'mods.modable_id')
            ->where('modable_type', TrackMod::class)
            ->where('mods.status', 'published')
            ->select('track_mods.*')
            ->with('mod.author')
            ->paginate($resultsPerPage);
    }
}
