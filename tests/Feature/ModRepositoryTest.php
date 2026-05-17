<?php

namespace Tests\Feature;

use App\Models\Mod;
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
}
