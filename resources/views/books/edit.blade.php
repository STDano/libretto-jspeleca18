@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">
            ← Back
        </a>

        <div class="card">
            
            <div class="card-header">Edit Book</div>
            <div class="card-body">
                <form action="{{ route('books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="author_id" class="form-label">Author</label>
                        <select name="author_id" class="form-select" required>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="genres" class="form-label">Genres</label>
                        <select name="genres[]" class="form-select" multiple>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ in_array($genre->id, $book->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
