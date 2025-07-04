<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    public function index(): View
    {
        return view('books.index', ['books' => Book::paginate(5)]);
    }

    public function create(): View
    {
        $authors = Author::all();
        $genres = Genre::all();
    
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create(attributes: [
            'title' => $request->title,
            'author_id' => $request->author_id,
        ]);

        $book->genres()->attach($request->genres);

        return redirect('books')->withSuccss('Book added successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }


    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
    
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);
    
        $book->update($validatedData);
    
        return redirect()->route('books.index')
            ->withSuccess('Book updated successfully');
    }

    public function destroy(request $request, Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->withSuccess('Book deleted successfully');
    }
}
