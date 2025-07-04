<?php

namespace App\Http\Controllers;

use App\Models\Author;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        return view('authors.index', ['authors' => Author::paginate(5)]);
    }

    public function create(): View
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Author::create([
            'name' => $request->name,
        ]);

        return redirect('authors')->withSuccss('Author added successfully.');
    }

    public function show(string $id)
    {
        return view('authors.show', compact('author'));
    }


    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    
        $author->update($validatedData);
    
        return redirect()->route('authors.index')
            ->withSuccess('Author updated successfully');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')
            ->withSuccess('Author deleted successfully');
    }
}
