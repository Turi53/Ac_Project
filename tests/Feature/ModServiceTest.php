<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\CarMod;
use App\Models\Make;
use App\Models\Mod;
use App\Models\TrackMod;
use App\Repositories\CarModRepository;
use App\Repositories\ModRepository;
use App\Repositories\TrackModRepository;
use App\Services\ModService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModServiceTest extends TestCase
{
   use RefreshDatabase;

   private ModService $modService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->modService = new ModService(new ModRepository(), new CarModRepository(), new TrackModRepository() );
    }

    public function test_that_create_car_mod_creates_a_car()
    {
        $make = Make::factory()->create();
        $carData = CarMod::factory()->make(['make_id' => $make->id])->toArray();
        $modData = [
            'description' => fake()->paragraph(),
            'download_link' => fake()->url(),
            'is_premium' => false,
            'author_id' => Author::factory()->create()->id,
            'published_at' => null,
        ];

        $carMod = $this->modService->createCarMod($carData, $modData);

        $this->assertDatabaseCount('car_mods', 1);
        $this->assertDatabaseCount('mods', 1);
        $this->assertInstanceOf(CarMod::class, $carMod);
        $this->assertInstanceOf(Mod::class, $carMod->mod);
    }

    public function test_that_create_track_mod_creates_a_track()
    {
        $trackData = CarMod::factory()->make()->toArray();
        $modData = [
            'description' => fake()->paragraph(),
            'download_link' => fake()->url(),
            'is_premium' => false,
            'author_id' => Author::factory()->create()->id,
            'published_at' => null,
        ];

        $trackMod = $this->modService->createCarMod($trackData, $modData);

        $this->assertDatabaseCount('car_mods', 1);
        $this->assertDatabaseCount('mods', 1);
        $this->assertInstanceOf(CarMod::class, $trackMod);
        $this->assertInstanceOf(Mod::class, $trackMod->mod);
    }

    public function test_that_a_car_mod_is_updated()
    {
        $mod = Mod::factory()->create(['modable_type' => CarMod::class]);
        $originalCarMod = $mod->modable;

        $updatedCarMod = $this->modService->updateCarMod(
            $originalCarMod->id,
            ['model' => 'mondeo'],
            ['description' => 'blue car']
        );

        $this->assertSame('blue car', $updatedCarMod->mod->description);
        $this->assertSame('mondeo', $updatedCarMod->model);
    }

    public function test_that_a_track_mod_is_updated()
    {
        $mod = Mod::factory()->create(['modable_type' => TrackMod::class]);
        $originalTrackMod = $mod->modable;

        $updatedTrackMod = $this->modService->updateTrackMod(
            $originalTrackMod->id,
            ['country' => 'portugal'],
            ['description' => 'slow track']
        );

        $this->assertSame('slow track', $updatedTrackMod->mod->description);
        $this->assertSame('portugal', $updatedTrackMod->country);
    }

    public function test_that_a_car_mod_is_deleted()
    {
        $mod = Mod::factory()->create(['modable_type' => CarMod::class]);

        $carMod = $mod->modable;

        $this->modService->deleteCarMod($carMod->id);

        $this->assertDatabaseEmpty('mods');
        $this->assertDatabaseEmpty('car_mods');
        $this->assertModelMissing($mod);
        $this->assertModelMissing($carMod);
    }

    public function test_that_a_track_mod_is_deleted()
    {
        $mod = Mod::factory()->create(['modable_type' => TrackMod::class]);

        $trackMod = $mod->modable;

        $this->modService->deleteTrackMod($trackMod->id);

        $this->assertDatabaseEmpty('mods');
        $this->assertDatabaseEmpty('track_mods');
        $this->assertModelMissing($mod);
        $this->assertModelMissing($trackMod);
    }
}
