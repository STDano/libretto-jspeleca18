<?php

namespace App\Http\Controllers;

use App\Models\Genre;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GenreController extends Controller
{
    public function index(): View
    {
        return view('genres.index', ['genres' => Genre::paginate(5)]);
    }

    public function create(): View
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        Genre::create(attributes: [
            'name' => $request->name,
        ]);


        return redirect('genres')->withSuccss('genre added successfully.');
    }

    public function show(string $id)
    {
        return view('genres.show', compact('genre'));
    }


    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }
    public function update(Request $request, Genre $genre)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    
        $genre->update($validatedData);
    
        return redirect()->route('genres.index')
            ->withSuccess('Genre updated successfully');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')
            ->withSuccess('Genre deleted successfully');
    }
}
