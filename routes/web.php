<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScreeningController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [ScreeningController::class, 'home'])->name('welcome');

Route::middleware('role:admin')->group(function () {
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/actors', [ActorController::class, 'index'])->name('actor.index');
    Route::post('/dashboard/actors', [ActorController::class, 'store'])->name('actor.store');
    Route::patch('/dashboard/actors/edit/{actor}', [ActorController::class, 'update'])->name('actor.update');
    Route::delete('/dashboard/actors/delete/{actor}', [ActorController::class, 'destroy'])->name('actor.delete');

    Route::get('/dashboard/genres', [GenreController::class, 'index'])->name('genre.index');
    Route::post('/dashboard/genres', [GenreController::class, 'store'])->name('genre.store');
    Route::patch('/dashboard/genres/edit/{genre}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/dashboard/genres/delete/{genre}', [GenreController::class, 'destroy'])->name('genre.delete');

    Route::get('/dashboard/films', [FilmController::class, 'index'])->name('film.index');
    Route::post('/dashboard/films', [FilmController::class, 'store'])->name('film.store');
    Route::patch('/dashboard/films/edit/{film}', [FilmController::class, 'update'])->name('film.update');
    Route::delete('/dashboard/films/delete/{film}', [FilmController::class, 'destroy'])->name('film.delete');

    Route::get('/dashboard/halls', [HallController::class, 'index'])->name('hall.index');
    Route::post('/dashboard/halls', [HallController::class, 'store'])->name('hall.store');
    Route::patch('/dashboard/halls/edit/{hall}', [HallController::class, 'update'])->name('hall.update');
    Route::delete('/dashboard/halls/delete/{hall}', [HallController::class, 'destroy'])->name('hall.delete');

    Route::get('/dashboard/screenings', [ScreeningController::class, 'index'])->name('screening.index');
    Route::post('/dashboard/screenings', [ScreeningController::class, 'store'])->name('screening.store');
    Route::patch('/dashboard/screenings/edit/{screening}', [ScreeningController::class, 'update'])->name('screening.update');
    Route::delete('/dashboard/screenings/delete/{screening}', [ScreeningController::class, 'destroy'])->name('screening.delete');
});


    Route::get('/films', [FilmController::class, 'all'])->name('films.index');
    Route::get('/films/{film}', [FilmController::class, 'show'])->name('film.show');


Route::middleware('role:member')->group(function () {

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservation.show');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'delete'])->name('reservation.delete');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
});


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
