<?php

namespace App\Repositories;

use App\Models\CarMod;
use App\Models\Mod;

class CarModRepository
{
    public function getPaginated(int $resultsPerPage = 9)
    {
        return CarMod::paginate($resultsPerPage);
    }

    public function findById(int $id): CarMod
    {
        return CarMod::find($id);
    }

    public function create(array $data): CarMod
    {
        return CarMod::create($data);
    }
}
