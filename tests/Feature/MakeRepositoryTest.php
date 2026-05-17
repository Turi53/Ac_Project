<?php

namespace Tests\Feature;

use App\Models\Make;
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

    public function test_that_make_is_deleted(): void
    {
        $make = Make::factory()->create();

        $this->makeRepository->delete($make->id);

        $this->assertModelMissing($make);
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
