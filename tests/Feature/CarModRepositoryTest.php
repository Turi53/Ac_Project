<?php

namespace Tests\Feature;

use App\Models\CarMod;
use App\Repositories\CarModRepository;
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

        $result = $this->carModRepository->findById($carMod);

        $this->assertEquals($carMod->id, $result->id);
    }
}
