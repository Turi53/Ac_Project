<?php

namespace Tests\Feature;

use App\Models\CarMod;
use App\Models\Make;
use App\Models\Mod;
use App\Repositories\MakeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MakeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private MakeRepository $makeRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->makeRepository = new MakeRepository();
    }

    public function test_that_make_is_created()
    {
        $data = [
            'name' => 'Ferrari',
        ];

        $make = $this->makeRepository->create($data);

        $this->assertDatabaseCount('makes', 1);
        $this->assertInstanceOf(Make::class, $make );
    }

    public function test_that_make_and_related_car_mods_are_deleted(): void
    {
        $make = Make::factory()->create();

        $carMod1 = CarMod::factory()->create([
            'make_id' => $make->id,
        ]);

        $carMod2 = CarMod::factory()->create([
            'make_id' => $make->id,
        ]);

        Mod::factory()->create([
            'modable_type' => CarMod::class,
            'modable_id' => $carMod1->id
        ]);

        Mod::factory()->create([
            'modable_type' => CarMod::class,
            'modable_id' => $carMod2->id
        ]);

        $this->makeRepository->delete($make->id);

        $this->assertModelMissing($make);

        $this->assertDatabaseEmpty('car_mods');
        $this->assertDatabaseEmpty('mods');
    }

    public function test_that_make_is_updated(): void
    {
        $make = Make::factory()->create([
            'name' => 'Ferrari',
        ]);

        $updatedMake = $this->makeRepository->update($make->id, [
            'name' => 'BMW',
        ]);

        $this->assertSame('BMW', $updatedMake->name);
    }

    public function test_that_find_all_retrieves_all_authors()
    {
        Make::factory()->count(8)->create();

        $make = $this->makeRepository->getAll();

        $this->assertCount(8, $make);
    }

    public function test_that_find_by_id_retrieves_correct_author(): void
    {
        $make = Make::factory()->create();

        $result = $this->makeRepository->findById($make->id);

        $this->assertInstanceOf(Make::class, $result);
        $this->assertEquals($make->id, $result->id);
    }
}
