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

    public function getUnpublished(int $resultsPerPage = 9)
    {
        return TrackMod::join('mods', 'track_mods.id', '=', 'mods.modable_id')
            ->where('modable_type', TrackMod::class)
            ->where('mods.status', 'unpublished')
            ->select('track_mods.*')
            ->with('mod.author')
            ->paginate($resultsPerPage);
    }

    public function getDrafts(int $resultsPerPage = 9)
    {
        return TrackMod::join('mods', 'track_mods.id', '=', 'mods.modable_id')
            ->where('modable_type', TrackMod::class)
            ->where('mods.status', 'draft')
            ->select('track_mods.*')
            ->with('mod.author')
            ->paginate($resultsPerPage);
    }

    public function findById(int $id): TrackMod
    {
        return TrackMod::find($id);
    }

}
