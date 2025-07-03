<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'genres')->get();
        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
        ]);

        $book->genres()->attach($validated['genres']);

        return response()->json($book->load('author', 'genres'), 201);
    }

    public function show(Book $book)
    {
        return $book->load('author', 'genres');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author_id' => 'sometimes|exists:authors,id',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update($validated);

        if (isset($validated['genres'])) {
            $book->genres()->sync($validated['genres']);
        }

        return $book->load('author', 'genres');
    }

    public function destroy(Book $book)
    {
        $book->genres()->detach();
        $book->delete();

        return response()->json(null, 204);
    }
}
