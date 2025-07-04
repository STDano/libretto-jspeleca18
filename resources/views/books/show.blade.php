@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-10">

        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">
            ← Back
        </a>

        <div class="card mb-4">
            <div class="card-header">Book Details</div>
            <div class="card-body">
                <h4>{{ $book->title }}</h4>
                <p><strong>Author:</strong> {{ $book->author->name ?? 'N/A' }}</p>
                <p><strong>Genres:</strong>
                    @foreach($book->genres as $genre)
                        <span class="badge bg-primary">{{ $genre->name }}</span>
                    @endforeach
                </p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <span>Reviews</span>
            </div>
            <div class="card-body">
                @foreach($book->reviews as $review)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Rating:</strong> {{ $review->rating }}/5
                            <div>
                                <a href="{{ route('reviews.edit', [$book->id, $review->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('reviews.destroy', [$book->id, $review->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <p class="mt-2">{{ $review->content }}</p>
                    </div>
                @endforeach

                @if($book->reviews->isEmpty())
                    <p class="text-muted">No reviews yet.</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">Add a Review</div>
            <div class="card-body">
                <form action="{{ route('reviews.store', $book->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" class="form-select" required>
                            <option value="" disabled selected>Select rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Review</label>
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
