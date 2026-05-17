<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private AuthorRepository $authorRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authorRepository = new AuthorRepository();
    }

    public function test_that_author_is_created()
    {
        $data = [
            'name' => 'Fazani',
        ];

        $author = $this->authorRepository->create($data);

        $this->assertDatabaseCount('authors', 1);
        $this->assertInstanceOf(Author::class, $author );
    }

    public function test_that_author_is_deleted(): void
    {
        $author = Author::factory()->create();

        $this->authorRepository->delete($author->id);

        $this->assertModelMissing($author);
    }

    public function test_that_author_is_updated(): void
    {
        $author = Author::factory()->create([
            'name' => 'Fazani',
        ]);

        $updatedAuthor = $this->authorRepository->update($author->id, [
            'name' => 'Pushin P',
        ]);

        $this->assertSame('Pushin P', $updatedAuthor->name);
    }

    public function test_that_find_all_retrieves_all_authors()
    {
        Author::factory()->count(8)->create();

        $authors = $this->authorRepository->getAll();

        $this->assertCount(8, $authors);
    }

    public function test_that_find_by_id_retrieves_correct_author(): void
    {
        $author = Author::factory()->create();

        $result = $this->authorRepository->findById($author->id);

        $this->assertInstanceOf(Author::class, $result);
        $this->assertEquals($author->id, $result->id);
    }
}
