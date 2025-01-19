<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/news/latest', [NewsController::class, 'latest'])->name('news.latest');
Route::get('/news/landing', [NewsController::class, 'landing'])->name('news.landing');

Route::get('/publications/landing', [PublicationController::class, 'landing'])->name('publications.landing');