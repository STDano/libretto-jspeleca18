@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Genres</span>
                <a href="{{ route('genres.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New Genre
                </a>
            </div>

            <div class="card-body">
                @if($genres->count())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($genres as $genre)
                                <tr>
                                    <td>{{ $genre->name }}</td>
                                    <td>
                                        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this genre?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $genres->links() }}
                @else
                    <p class="text-muted">No genres found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
