@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">
            ← Back
        </a>

        <div class="card">
            <div class="card-header">Add New Book</div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="author_id" class="form-label">Author</label>
                        <select name="author_id" class="form-select" required>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="genres" class="form-label">Genres</label>
                        <select name="genres[]" class="form-select" multiple>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
