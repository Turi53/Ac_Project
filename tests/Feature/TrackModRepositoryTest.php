<?php

namespace Tests\Feature;

use App\Models\Mod;
use App\Models\TrackMod;
use App\Repositories\TrackModRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackModRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TrackModRepository $trackModRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->trackModRepository = new TrackModRepository();
    }

    public function test_that_only_published_track_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'modable_type' => TrackMod::class,
            'status' => 'draft'
        ]);

        $trackMod = TrackMod::factory()->create();
        Mod::factory()->create([
            'status' => 'published',
            'modable_id' => $trackMod->id,
            'modable_type' => TrackMod::class,
        ]);

        $trackMods = $this->trackModRepository->getPublished();

        $this->assertSame(1, $trackMods->count());
    }

    public function test_that_only_unpublished_track_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'modable_type' => TrackMod::class,
            'status' => 'published'
        ]);

        $trackMod = TrackMod::factory()->create();
        Mod::factory()->create([
            'status' => 'unpublished',
            'modable_id' => $trackMod->id,
            'modable_type' => TrackMod::class,
        ]);

        $trackMods = $this->trackModRepository->getUnpublished();

        $this->assertSame(1, $trackMods->count());
    }

    public function test_that_only_draft_track_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'modable_type' => TrackMod::class,
            'status' => 'published'
        ]);

        $trackMod = TrackMod::factory()->create();
        Mod::factory()->create([
            'status' => 'draft',
            'modable_id' => $trackMod->id,
            'modable_type' => TrackMod::class,
        ]);

        $trackMods = $this->trackModRepository->getDrafts();

        $this->assertSame(1, $trackMods->count());
    }

    public function test_that_find_by_id_returns_correct_model(): void
    {
        $trackMod = TrackMod::factory()->create();

        $result = $this->trackModRepository->findById($trackMod->id);

        $this->assertEquals($trackMod->id, $result->id);
    }

    public function test_that_track_mod_is_created(): void
    {
        $data = [
            'name' => 'Silverstone',
            'distance' => 3.8,
            'number_of_pits' => 12,
            'country' => 'UK',
            'city' => 'London',
        ];

        $this->trackModRepository->create($data);

        $this->assertDatabaseCount('track_mods', 1);
    }

    public function test_that_track_mod_is_updated(): void
    {
        $trackMod = TrackMod::factory()->create([
            'country' => 'brazil',
        ]);

        $updatedCarMod = $this->trackModRepository->update($trackMod->id, [
            'country' => 'spain',
        ]);

        $this->assertSame('spain', $updatedCarMod->country);
    }
}
