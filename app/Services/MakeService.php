<?php

namespace App\Services;

use App\Models\Make;
use App\Repositories\MakeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MakeService
{
    private MakeRepository $makeRepository;

    public function __construct(MakeRepository $makeRepository)
    {
        $this->makeRepository = $makeRepository;
    }

    public function createMake(array $data): Make
    {
        return $this->makeRepository->create($data);
    }

    public function updateMake(int $id, array $data): Make
    {
        return $this->makeRepository->update($id, $data);
    }

    public function deleteMake(int $id): void
    {
        $this->makeRepository->delete($id);
    }

    public function getAllMakes(): Collection
    {
        return $this->makeRepository->getAll();
    }

    public function getMakes(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->makeRepository->getPaginated($resultsPerPage);
    }

    public function findMake(int $id): Make
    {
        return $this->makeRepository->findById($id);
    }
}
