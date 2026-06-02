<?php

namespace App\Repositories;

use App\Models\Make;
use Illuminate\Database\Eloquent\Collection;

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
        $make = Make::findOrFail($id);

        $make->delete();
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
