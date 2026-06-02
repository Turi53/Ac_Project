<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorRepository
{
    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function update(int $id, array $data): Author
    {
        $author = Author::findOrFail($id);

        $author->update($data);

        return $author;
    }

    public function delete(int $id): void
    {
        $author = Author::findOrFail($id);

        $author->delete();
    }

    public function getAll(): Collection
    {
        return Author::all();
    }

    public function getPaginated(int $resultPerPage = 9): LengthAwarePaginator
    {
        return Author::paginate($resultPerPage);
    }

    public function findById(int $id): Author
    {
        return Author::findOrFail($id);
    }
}
