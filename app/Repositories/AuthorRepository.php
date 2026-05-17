<?php

namespace App\Repositories;

use App\Models\Author;

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

    public function getAll(int $resultPerPage = 9)
    {
        return Author::paginate($resultPerPage);
    }

    public function findById(int $id): Author
    {
        return Author::find($id);
    }
}
