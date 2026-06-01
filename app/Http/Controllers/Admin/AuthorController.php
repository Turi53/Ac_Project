<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService) {
        $this->$authorService = $authorService;
    }

    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Author $author)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Author $author)
    {
        //
    }
}
