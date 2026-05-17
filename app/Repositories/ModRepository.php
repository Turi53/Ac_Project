<?php

namespace App\Repositories;

use App\Models\CarMod;
use App\Models\Mod;
use App\Models\TrackMod;

class ModRepository
{
    public function getPublished(int $resultsPerPage = 9)
    {
        return Mod::whereIn('modable_type', [CarMod::class, TrackMod::class])
            ->where('mods.status', 'published')
            ->with(['modable'])
            ->paginate($resultsPerPage);
    }

    public function getUnpublished(int $resultsPerPage = 9)
    {
        return Mod::whereIn('modable_type', [CarMod::class, TrackMod::class])
            ->where('mods.status', 'unpublished')
            ->with(['modable'])
            ->paginate($resultsPerPage);
    }

    public function getDrafts(int $resultsPerPage = 9)
    {
        return Mod::whereIn('modable_type', [CarMod::class, TrackMod::class])
            ->where('mods.status', 'draft')
            ->with(['modable'])
            ->paginate($resultsPerPage);
    }
}
