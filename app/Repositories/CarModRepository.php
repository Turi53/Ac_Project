<?php

namespace App\Repositories;

use App\Models\CarMod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CarModRepository
{
    public function getPaginated(int $resultsPerPage = 9)
    {
        return CarMod::paginate($resultsPerPage);
    }

    public function getPublished(int $resultsPerPage = 9)
    {
        return CarMod::join('mods', 'car_mods.id', '=', 'mods.modable_id')
            ->where('modable_type', CarMod::class)
            ->where('mods.status', 'published')
            ->select('car_mods.*')
            ->with(['mod.author', 'make'])
            ->paginate($resultsPerPage);
    }

    public function findById(int $id): CarMod
    {
        return CarMod::find($id);
    }

    public function create(array $data): CarMod
    {
        return CarMod::create($data);
    }

    public function update(int $id, array $data): CarMod
    {
        $carMod = CarMod::findOrFail($id);

        $carMod->update($data);

        return $carMod;
    }

    public function delete(int $id)
    {
        $carMod = CarMod::findOrFail($id);

        DB::transaction(function() use ($carMod) {
            $carMod->mod->deleteOrFail();
            $carMod->deleteOrFail();
        });
    }
}
