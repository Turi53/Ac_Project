<?php

namespace App\Repositories;

use App\Models\CarMod;
use App\Models\Mod;
use App\Models\TrackMod;
use Illuminate\Support\Facades\DB;

class ModRepository
{
    public function findById(int $id): TrackMod
    {
        return TrackMod::find($id);
    }

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

    public function create(array $data): Mod
    {
        return Mod::create($data);
    }

    public function update(int $id, array $data): Mod
    {
        $mod = Mod::findOrFail($id);

        $mod->update($data);

        return $mod;
    }

    public function delete(int $id): void
    {
        $mod = Mod::findOrFail($id);

        DB::transaction(function() use ($mod) {
            $mod->modable->deleteOrFail();
            $mod->deleteOrFail();
        });
    }
}
