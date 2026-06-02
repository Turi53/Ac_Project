<?php

namespace App\Services;

use App\Models\CarMod;
use App\Models\TrackMod;
use App\Repositories\CarModRepository;
use App\Repositories\ModRepository;
use App\Repositories\TrackModRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ModService
{
    private ModRepository $modRepository;
    private CarModRepository $carModRepository;
    private TrackModRepository $trackModRepository;

    public function __construct(ModRepository $modRepository, CarModRepository $carModRepository, TrackModRepository $trackModRepository) {
        $this->modRepository = $modRepository;
        $this->carModRepository = $carModRepository;
        $this->trackModRepository = $trackModRepository;
    }

    /**
     * @throws \Throwable
     */
    public function createCarMod(array $modData, array $carData): CarMod
    {
       return DB::transaction(function() use($modData, $carData) {
            $carMod = $this->carModRepository->create($carData);

            $this->modRepository->create([...$modData,
                'modable_type' => CarMod::class,
                'modable_id' => $carMod->id
            ]);

            return $carMod;
        });
    }

    /**
     * @throws \Throwable
     */
    public function createTrackMod(array $trackData, array $modData): TrackMod
    {
        return DB::transaction(function() use($modData, $trackData){
            $trackMod = $this->trackModRepository->create($trackData);

            $this->modRepository->create([...$modData,
                'modable_type' => TrackMod::class,
                'modable_id' => $trackMod->id
            ]);

            return $trackMod;
        });
    }

    /**
     * @throws \Throwable
     */
    public function updateCarMod(int $id, array $carData, array $modData): CarMod
    {
        $carMod = $this->carModRepository->findById($id);

        return DB::transaction(function() use($carMod, $modData, $carData) {
            $this->modRepository->update($carMod->mod->id, $modData);
            return $this->carModRepository->update($carMod->id, $carData);
        });
    }

    /**
     * @throws \Throwable
     */
    public function updateTrackMod(int $id, array $modData, array $trackData): TrackMod
    {
        $trackMod = $this->trackModRepository->findById($id);

        return DB::transaction(function() use($trackMod, $modData, $trackData) {
            $this->modRepository->update($trackMod->mod->id, $modData);
            return $this->trackModRepository->update($trackMod->id, $trackData);
        });
    }

    public function deleteCarMod(int $id): void
    {
        $this->carModRepository->delete($id);
    }

    public function deleteTrackMod(int $id): void
    {
        $this->trackModRepository->delete($id);
    }

    public function getPublishedCarMods(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->carModRepository->getPublished($resultsPerPage);
    }

    public function getPublishedTrackMods(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->trackModRepository->getPublished($resultsPerPage);
    }

    public function getUnpublishedCarMods(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->carModRepository->getUnpublished($resultsPerPage);
    }

    public function getUnpublishedTrackMods(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->trackModRepository->getUnpublished($resultsPerPage);
    }

    public function getDraftCarMods(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->carModRepository->getDrafts($resultsPerPage);
    }

    public function getDraftTrackMods(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->trackModRepository->getDrafts($resultsPerPage);
    }

    public function findCarMod($id): CarMod
    {
        return $this->carModRepository->findById($id);
    }

    public function findTrackMod($id): TrackMod
    {
        return $this->trackModRepository->findById($id);
    }
}
