<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class)
    ->only(['index', 'show']);

Route::get('books/{book}/reviews/create', [ReviewController::class, 'create'])
    ->name('books.reviews.create');

Route::middleware(['throttle:reviews'])->group(function (){
    Route::post('books/{book}/reviews', [ReviewController::class, 'store'])->name('books.reviews.store');
});
