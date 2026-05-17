<?php

namespace App\Repositories;

use App\Models\TrackMod;
use Illuminate\Support\Facades\DB;

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

    public function create(array $data): TrackMod
    {
        return TrackMod::create($data);
    }

    public function update(int $id, array $data): TrackMod
    {
        $trackMod = TrackMod::findOrFail($id);

        $trackMod->update($data);

        return $trackMod;
    }

    public function delete(int $id)
    {
        $trackMod = TrackMod::findOrFail($id);

        DB::transaction(function() use ($trackMod) {
            $trackMod->mod->deleteOrFail();
            $trackMod->deleteOrFail();
        });
    }
}
