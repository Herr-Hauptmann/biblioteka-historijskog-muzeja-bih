<?php

// Kontroleri
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\KeywordController;

// Middleware
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;
use Inertia\Inertia;



//Admin panel
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::resource('books', BookController::class)->except(['show']);
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::resource('keywords', KeywordController::class)->except(['show']);
});


//Public routes
Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/about', [HomeController::class, 'about'])->name('about'); 
Route::get('/books/list', [BookController::class, 'list'])->name('books.list');
Route::get('/keywords/{id}', [KeywordController::class, 'show'])->name('keywords.show');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
