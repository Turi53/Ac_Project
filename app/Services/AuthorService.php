<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository) {
        $this->authorRepository = $authorRepository;
    }

    public function createAuthor(array $data): Author
    {
        return $this->authorRepository->create($data);
    }

    public function updateAuthor(int $id, array $data): Author
    {
        return $this->authorRepository->update($id, $data);
    }

    public function deleteAuthor(int $id): void
    {
        $this->authorRepository->delete($id);
    }

    public function getAuthors(int $resultsPerPage = 9): LengthAwarePaginator
    {
        return $this->authorRepository->getAll($resultsPerPage);
    }

    public function findAuthor(int $id): Author
    {
        return $this->authorRepository->findById($id);
    }
}
