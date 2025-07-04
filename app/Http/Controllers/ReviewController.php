<?php

namespace App\Http\Controllers;

use App\Models\Review;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book = Book::findOrFail($bookId);

        $review = new Review([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        $book->reviews()->save($review);

        return redirect()->route('books.show', $bookId)->with('success', 'Review added successfully!');
    }

    public function edit($bookId, $reviewId)
    {
        $review = Review::where('book_id', $bookId)->findOrFail($reviewId);

        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, $bookId, $reviewId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::where('book_id', $bookId)->findOrFail($reviewId);
        $review->update($request->only(['content', 'rating']));

        return redirect()->route('books.show', $bookId)->with('success', 'Review updated successfully!');
    }

    public function destroy($bookId, $reviewId)
    {
        $review = Review::where('book_id', $bookId)->findOrFail($reviewId);
        $review->delete();

        return redirect()->route('books.show', $bookId)->with('success', 'Review deleted successfully!');
    }
}
