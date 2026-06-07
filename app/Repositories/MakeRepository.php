<?php

namespace App\Repositories;

use App\Models\CarMod;
use App\Models\Make;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MakeRepository
{
    public function create(array $data): Make
    {
        return Make::create($data);
    }

    public function update(int $id, array $data): Make
    {
        $make = Make::findOrFail($id);

        $make->update($data);

        return $make;
    }

    public function delete(int $id): void
    {
        DB::transaction(function () use($id) {
            $make = Make::findOrFail($id);

            $carModIds = $make->carMods()->pluck('id');

            DB::table('mods')
                ->where('modable_type', CarMod::class)
                ->whereIn('modable_id', $carModIds)
                ->delete();

            DB::table('car_mods')
                ->where('make_id', $make->id)
                ->delete();

            $make->delete();
        });
    }

    public function getAll(): Collection
    {
        return Make::all();
    }

    public function getPaginated(int $resultPerPage = 9)
    {
        return Make::paginate($resultPerPage);
    }

    public function findById(int $id): Make
    {
        return Make::findOrFail($id);
    }
}
