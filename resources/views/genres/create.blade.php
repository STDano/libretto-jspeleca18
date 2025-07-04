@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <a href="{{ route('genres.index') }}" class="btn btn-secondary mb-3">
            ← Back
        </a>

        <div class="card">
            <div class="card-header">Add New Genre</div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('genres.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Genre Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Genre</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
