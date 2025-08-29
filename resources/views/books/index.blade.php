@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>

    <form method="GET" action="{{ route('books.index') }}" class="flex mb-6 gap-4  w-2xl">
        <input type="text" name="title" placeholder="Search by title" value="{{request('title')}}" class="input"/>
        <input type="hidden" name="filter" value="{{ request('filter') }}"/>
        <button type="submit" class="btn cursor-pointer">Submit</button>
        <a href="{{ route('books.index') }}" class="btn">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_six_months' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_six_months' => 'Highest Rated Last 6 Months'
            ];
        @endphp

        @foreach($filters as $key => $label)
            <a
                href="{{ route('books.index', ['page' => 1, 'filter' => $key, 'title' => request('title')]) }}"
                @class(['filter-item', 'filter-item-active' => ($key === '' && !request('filter') || request('filter') === $key )])
            >{{$label}}</a>
        @endforeach
    </div>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div
                        class="flex flex-wrap items-center justify-between w-3xl">
                        <div class="w-3/4 lex-grow whitespace-nowrap overflow-hidden overflow-ellipsis">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div class="w-[120px]">
                            <div class="book-rating">
                                <x-star-rating :rating="$book->reviews_avg_rating"/>
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>

    <div class="mt-6 w-3xl">
        {{$books->links()}}
    </div>
@endsection
