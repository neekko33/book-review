<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|min:15',
        ]);

        $book->reviews()->create($data);

        return redirect()->route('books.show', $book);
    }
}
