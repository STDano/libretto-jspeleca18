@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Authors</span>
                <a href="{{ route('authors.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New Author
                </a>
            </div>

            <div class="card-body">
                @if($authors->count())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>{{ $author->name }}</td>
                                    <td>
                                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this author?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $authors->links() }}
                @else
                    <p class="text-muted">No authors found.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
