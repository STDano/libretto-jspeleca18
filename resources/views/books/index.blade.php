@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Books</span>
                <a href="{{ route('books.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New Book
                </a>
            </div>

            <div class="card-body">
                @if($books->count())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genres</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author->name ?? 'N/A' }}</td>
                                    <td>
                                        @foreach($book->genres as $genre)
                                            <span class="badge bg-primary">{{ $genre->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $books->links() }}
                @else
                    <p class="text-muted">No books available.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
