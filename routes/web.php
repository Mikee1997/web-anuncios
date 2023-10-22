<?php

use App\Http\Controllers\AnunciosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickPointController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', [AnunciosController::class, 'mostrarAnuncios'])->name('index');
Route::get('/detalle/{idAnuncio}', [AnunciosController::class, 'detailAd'])->name('detailAd');




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('ad.')->group(function () {
        Route::get('/crear-anuncio', [AnunciosController::class, 'createAd'])->name('create');
        Route::post('/crear-anuncio', [AnunciosController::class, 'storeAd'])->name('store');
        Route::get('/anuncio/{id}', [AnunciosController::class, 'edit'])->name('edit');
        Route::patch('/anuncio/{id}', [AnunciosController::class, 'update'])->name('update');
        Route::delete('/anuncio/{id}', [AnunciosController::class, 'destroy'])->name('delete');
        Route::get('/reservar-anuncio{id}', [AnunciosController::class, 'reserve'])->name('reserve');
        Route::post('/reservar-anuncio{id}', [AnunciosController::class, 'reserveSave'])->name('reserveSave');


    });

    Route::
    //middleware('admin')->
    name('pickPoints.')->group(function () {
        Route::get('pickpoint', [PickPointController::class, 'index'])->name('index');
        Route::get('/crear-pickpoint', [PickPointController::class, 'create'])->name('create');
        Route::post('/crear-pickpoint', [PickPointController::class, 'store'])->name('store');
        Route::get('/pickpoint/{id}', [PickPointController::class, 'edit'])->name('edit');
        Route::patch('/pickpoint/{id}', [PickPointController::class, 'update'])->name('update');
        Route::delete('/pickpoint/{id}', [PickPointController::class, 'destroy'])->name('delete');
    });
});

require __DIR__ . '/auth.php';
