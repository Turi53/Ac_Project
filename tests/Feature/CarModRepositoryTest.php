<?php

namespace Tests\Feature;

use App\Models\CarMod;
use App\Models\Make;
use App\Models\Mod;
use App\Repositories\CarModRepository;
use Database\Factories\MakeFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarModRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $carModRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->carModRepository = new CarModRepository();
    }

    public function test_that_get_paginated_returns_paginated_results(): void
    {
        CarMod::factory()->count(10)->create();

        $result = $this->carModRepository->getPaginated();

        $this->assertCount(9, $result);
    }

    public function test_that_findById_returns_correct_model(): void
    {
        $carMod = CarMod::factory()->create();

        $result = $this->carModRepository->findById($carMod->id);

        $this->assertEquals($carMod->id, $result->id);
    }

    public function test_that_car_mod_is_created(): void
    {
        $make = Make::factory()->create();

        $data = [
            'model' => 'camery',
            'year_of_manufacture' => 2002,
            'power' => 120,
            'torque' => 110,
            'zero_to_100' => 9.2,
            'weight' => 1400,
            'top_speed' => 220,
            'make_id' => $make->id,
        ];

        $this->carModRepository->create($data);

        $this->assertDatabaseCount('car_mods', 1);
    }

    public function test_that_car_mod_is_updated(): void
    {
        $carMod = CarMod::factory()->create();

        $updatedCarMod = $this->carModRepository->update($carMod->id, [
            'year_of_manufacture' => 2000,
        ]);

        $this->assertSame(2000, $updatedCarMod->year_of_manufacture);
    }

    public function test_that_car_mod_is_deleted(): void
    {
        $carMod = CarMod::factory()->create();

        $mod = Mod::factory()->create([
            'modable_id' => $carMod->id,
            'modable_type' => CarMod::class,
        ]);

        $this->carModRepository->delete($carMod->id);

        $this->assertModelMissing($mod);
        $this->assertModelMissing($carMod);
    }

    public function test_that_only_published_car_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'modable_type' => CarMod::class,
            'status' => 'draft'
        ]);

        $carMod = CarMod::factory()->create();
        Mod::factory()->create([
            'status' => 'published',
            'modable_id' => $carMod->id,
            'modable_type' => CarMod::class,
        ]);

        $carMods = $this->carModRepository->getPublished();

        $this->assertSame(1, $carMods->count());
    }

    public function test_that_only_unpublished_car_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'modable_type' => CarMod::class,
            'status' => 'published'
        ]);

        $carMod = CarMod::factory()->create();
        Mod::factory()->create([
            'status' => 'unpublished',
            'modable_id' => $carMod->id,
            'modable_type' => CarMod::class,
        ]);

        $carMods = $this->carModRepository->getUnpublished();

        $this->assertSame(1, $carMods->count());
    }

    public function test_that_only_drafts_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'modable_type' => CarMod::class,
            'status' => 'published'
        ]);

        $carMod = CarMod::factory()->create();
        Mod::factory()->create([
            'status' => 'draft',
            'modable_id' => $carMod->id,
            'modable_type' => CarMod::class,
        ]);

        $carMods = $this->carModRepository->getDrafts();

        $this->assertSame(1, $carMods->count());
    }
}
