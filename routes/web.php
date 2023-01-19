<?php


// Kontroleri
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

// Middleware
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;
use Inertia\Inertia;



Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/about', [HomeController::class, 'about'])->name('about'); 


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::resource('books', BookController::class);
    
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/search', [AuthorController::class, 'search'])->name('authors.search');
    Route::get('/authors/edit/{id}', [AuthorController::class, 'edit']);
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
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
