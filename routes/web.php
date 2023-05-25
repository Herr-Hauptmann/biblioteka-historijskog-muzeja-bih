<?php

// Kontroleri
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\NewsController;

// Middleware
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;
use Inertia\Inertia;

//Admin panel
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    //CRUD stuff
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('books', BookController::class)->except(['show']);
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::resource('keywords', KeywordController::class)->except(['show']);
    Route::resource('publications', PublicationController::class)->except(['show']);
    Route::resource('news', NewsController::class)->except(['show']);
    Route::get('publications/{publication}/download', [PublicationController::class, 'download'])->name('publications.download');
    
    //Import and export data
    Route::get('/dashboard/export', [AdminController::class, 'export'])->name('export');
    Route::get('/dashboard/import', [AdminController::class, 'import'])->name('import');
    Route::get('/export/books', [BookController::class, 'export'])->name('books.export');
    Route::post('/import/books', [BookController::class, 'import'])->name('books.import');
});

//Public routes

//Home routes
Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/about', [HomeController::class, 'about'])->name('about'); 
Route::get('/faq', [HomeController::class, 'faq'])->name('faq'); 

//Books routes
Route::get('/books/list', [BookController::class, 'list'])->name('books.list');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

//Keywords routes
Route::get('/keywords/{id}/books', [KeywordController::class, 'booksWithKeyword'])->name('keywords.books');
Route::get('/keywords/{id}', [KeywordController::class, 'show'])->name('keywords.show');

//Authors routes
Route::get('/authors/{id}/books', [AuthorController::class, 'booksOfAuthor'])->name('authors.books');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

//News routes
Route::get('/news/list', [NewsController::class, 'list'])->name('news.list');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

//Publications routes
Route::get('/publications/list', [PublicationController::class, 'list'])->name('publications.list');
Route::get('/publications/get/{id}', [PublicationController::class, 'get'])->name('publications.get');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('publications.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';