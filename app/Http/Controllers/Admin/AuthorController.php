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
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->getAuthors();

        return view('admin.authors.index', ['authors' => $authors]);
    }

    public function create()
    {
        return view('admin.authors.create', ['author' => new author]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:authors,name'],
        ]);

        $author = $this->authorService->createAuthor($data);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'The Author ' . $author->name . ' has successfully been created');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', ['author' => $author]);
    }

    public function update(Request $request, Author $author)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255',],
        ]);

        $this->authorService->updateAuthor($author->id, $data);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'The Author ' . $author->name . ' has successfully been updated');
    }

    public function destroy(Author $author)
    {
        $this->authorService->deleteAuthor($author->id);

        return redirect()->back()->with('success', 'The author ' . $author->name . ' has successfully been deleted');
    }
}
