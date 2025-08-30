@extends('Layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl w-2xl">Add Review for {{$book->title}}</h1>

    <form action="{{route('books.reviews.store', $book)}}" method="POST" class="w-2xl">
        @csrf
        <div class="mb-6">
            <label for="rating" class="block font-bold text-xl mb-2">Rating</label>
            <select id="rating" name="rating" class="input" required>
                <option value="">Select a rating </option>
                @for($i = 1;$i <= 5; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>

        <div class="mb-6">
            <label for="review" class="block font-bold text-xl mb-2">Review</label>
            <textarea id="review" name="review" class="input" rows="5" required></textarea>
        </div>

        <button class="btn" type="submit">Submit Review</button>
    </form>

@endsection
