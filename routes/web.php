<?php


// Kontroleri
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;

// Middleware
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;
use Inertia\Inertia;



Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/about', [HomeController::class, 'about'])->name('about'); 


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
    Route::get('/books/edit/{id}', [BookController::class, 'edit']);
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'logo_url' => Vite::asset('resources/images/logo-head.png'),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
