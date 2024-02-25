<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('role:admin')->group(function () {
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/actors', [ActorController::class, 'index'])->name('actor.index');
    Route::get('/dashboard/actors/edit/{actor}', [ActorController::class, 'edit'])->name('actor.edit');
    Route::patch('/dashboard/actors/edit/{actor}', [ActorController::class, 'update'])->name('actor.update');
    Route::post('/dashboard/actors', [ActorController::class, 'store'])->name('actor.store');
    Route::delete('/dashboard/actors/delete/{actor}', [ActorController::class, 'delete'])->name('actor.delete');
  
    Route::get('/dashboard/genres', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/dashboard/genres/edit/{genre}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::patch('/dashboard/genres/edit/{genre}', [GenreController::class, 'update'])->name('genre.update');
    Route::post('/dashboard/genres', [GenreController::class, 'store'])->name('genre.store');
    Route::delete('/dashboard/genres/delete/{genre}', [GenreController::class, 'delete'])->name('genre.delete');
    
    Route::get('/dashboard/films', [FilmController::class, 'index'])->name('film.index');
    Route::get('/dashboard/films/edit/{film}', [FilmController::class, 'edit'])->name('film.edit');
    Route::patch('/dashboard/films/edit/{film}', [FilmController::class, 'update'])->name('film.update');
    Route::post('/dashboard/films', [FilmController::class, 'store'])->name('film.store');
    Route::delete('/dashboard/films/delete/{film}', [FilmController::class, 'delete'])->name('film.delete');
    
    Route::get('/dashboard/halls', [HallController::class, 'index'])->name('hall.index');
    Route::get('/dashboard/halls/edit/{hall}', [HallController::class, 'edit'])->name('hall.edit');
    Route::patch('/dashboard/halls/edit/{hall}', [HallController::class, 'update'])->name('hall.update');
    Route::post('/dashboard/halls', [HallController::class, 'store'])->name('hall.store');
    Route::delete('/dashboard/halls/delete/{hall}', [HallController::class, 'delete'])->name('hall.delete');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
