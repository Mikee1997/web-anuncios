<?php

use App\Http\Controllers\AnunciosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnuncioController;

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



Route::get('/', [AnunciosController::class, 'mostrarAnuncios']);
Route::get('/detalle/{idAnuncio}',[AnunciosController::class, 'detailAd'])->name('detailAd');
Route::get('/crear-anuncio',[AnunciosController::class, 'createAd'])->name('createAd');
Route::post('/crear-anuncio',[AnunciosController::class, 'storeAd'])->name('storeAd');

