<?php

use App\Http\Controllers\AnunciosController;
use App\Http\Controllers\DashboardController;
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



Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('ad.')->group(function () {
        Route::get('/crear-anuncio', [AnunciosController::class, 'createAd'])->name('create');
        Route::post('/crear-anuncio', [AnunciosController::class, 'storeAd'])->name('store');
        Route::get('/anuncio/{id}', [AnunciosController::class, 'edit'])->name('edit');
        Route::patch('/anuncio/{id}', [AnunciosController::class, 'update'])->name('update');
        Route::delete('/anuncio/{id}', [AnunciosController::class, 'destroy'])->name('delete');
    });
});

require __DIR__ . '/auth.php';
