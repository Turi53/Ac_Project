<?php

namespace Tests\Feature;

use App\Models\Mod;
use App\Models\TrackMod;
use App\Models\Author;
use App\Repositories\ModRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ModRepository $modRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->modRepository = new modRepository();
    }

    public function test_that_find_by_id_retrieves_correct_mod(): void
    {
        $mod = Mod::factory()->create();

        $result = $this->modRepository->findById($mod->id);

        $this->assertEquals($mod->id, $result->id);
    }

    public function test_that_only_published_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'status' => 'draft'
        ]);

        Mod::factory()->count(8)->create([
            'status' => 'published',
        ]);

        $mods = $this->modRepository->getPublished();

        $this->assertSame(8, $mods->count());
    }

    public function test_that_only_unpublished_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'status' => 'published'
        ]);

        Mod::factory()->count(8)->create([
            'status' => 'unpublished',
        ]);

        $mods = $this->modRepository->getUnpublished();

        $this->assertSame(8, $mods->count());
    }

    public function test_that_only_draft_mods_are_retrieved(): void
    {
        Mod::factory()->count(4)->create([
            'status' => 'published'
        ]);

        Mod::factory()->count(7)->create([
            'status' => 'draft',
        ]);

        $mods = $this->modRepository->getDrafts();

        $this->assertSame(7, $mods->count());
    }

    public function test_that_mod_is_created(): void
    {
        $data = [
            'description' => fake()->paragraph(6),
            'download_link' => fake()->url(),
            'is_premium' => 1,
            'author_id' => Author::factory()->create()->id,
            'published_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'modable_type' => TrackMod::class,
            'modable_id' => TrackMod::factory()->create()->id,
        ];

        $this->modRepository->create($data);

        $this->assertDatabaseCount('mods', 1);
    }

    public function test_that_mod_is_updated(): void
    {
        $mod = Mod::factory()->create([
            'is_premium' => 0,
        ]);

        $updatedMod = $this->modRepository->update($mod->id, [
            'is_premium' => 1,
        ]);

        $this->assertSame(1, $updatedMod->is_premium);
    }

    public function test_that_mod_is_deleted(): void
    {
        $trackMod = TrackMod::factory()->create();

        $mod = Mod::factory()->create([
            'modable_id' => $trackMod->id,
            'modable_type' => TrackMod::class,
        ]);

        $this->modRepository->delete($mod->id);

        $this->assertModelMissing($mod);
        $this->assertModelMissing($trackMod);
    }
}
