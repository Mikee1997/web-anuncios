<?php

use App\Http\Controllers\AnunciosController;
use App\Http\Controllers\Controller;
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

//Pagina inicial donde veras todos los anuncos publicados, estes registrado o no.
Route::get('/', [AnunciosController::class, 'mostrarAnuncios'])->name('index');

// Detalle de un anuncio específico
Route::get('/detalle/{idAnuncio}', [AnunciosController::class, 'detailAd'])
->name('detailAd');

// Cambiar el idioma de la aplicación
Route::get('change-language/{locale}', [Controller::class, 'changeLanguage'])
    ->name('changeLanguage');


// Grupo de rutas protegidas por el middleware de autenticación
Route::middleware('auth')->group(function () {
    // Panel de control del usuario autenticado
    Route::get('/dashboard', [AnunciosController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

    // Editar perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');

    // Grupo de rutas relacionadas con los anuncios
    Route::name('ad.')->group(function () {
        // Crear un nuevo anuncio
        Route::get('/crear-anuncio', [AnunciosController::class, 'createAd'])
        ->name('create');
        Route::post('/crear-anuncio', [AnunciosController::class, 'storeAd'])
        ->name('store');
        // Editar, actualizar y eliminar anuncio
        Route::get('/anuncio/{id}', [AnunciosController::class, 'edit'])
        ->name('edit');
        Route::patch('/anuncio/{id}', [AnunciosController::class, 'update'])
        ->name('update');
        Route::delete('/anuncio/{id}', [AnunciosController::class, 'destroy'])
        ->name('delete');
        // Reservar un anuncio
        Route::get('/reservar-anuncio/{id}', [AnunciosController::class, 'reserve'])
        ->name('reserve');
        Route::post('/reservar-anuncio/{id}', [AnunciosController::class, 'reserveSave'])
        ->name('reserveSave');
        // Rutas con funcionalidades específicas para administradores
        Route::get('/delivered-datatable/{pickpoint}', [AnunciosController::class, 'deliveredDatatable'])
        ->name('deliveredDatatable')->middleware('admin');
        Route::get('/reserved-datatable/{pickpoint}', [AnunciosController::class, 'reservedDatatable'])
        ->name('reservedDatatable')->middleware('admin');
        Route::get('/pte-datatable/{pickpoint}', [AnunciosController::class, 'pteDatatable'])
        ->name('pteDatatable')->middleware('admin');

        //Ruta que permite listar los anuncios publicados por un usario
        Route::get('/myAdsDatatable', [AnunciosController::class, 'myAdsDatatable'])
        ->name('myAdsDatatable');
    });

    // Grupo de rutas relacionadas con los PickPoints (puntos de recogida)
    Route::name('pickPoints.')->group(function () {
        // Listar todos los PickPoints (solo para administradores)
        Route::get('pickpoint', [PickPointController::class, 'index'])->name('index')->middleware('admin');
        // Crear, editar, actualizar y eliminar PickPoint (solo para administradores)
        Route::get('/crear-pickpoint', [PickPointController::class, 'create'])->name('create')->middleware('admin');
        Route::post('/crear-pickpoint', [PickPointController::class, 'store'])->name('store')->middleware('admin');
        Route::get('/pickpoint/{id}', [PickPointController::class, 'edit'])->name('edit')->middleware('admin');
        Route::patch('/pickpoint/{id}', [PickPointController::class, 'update'])->name('update')->middleware('admin');
        Route::delete('/pickpoint/{id}', [PickPointController::class, 'destroy'])->name('delete')->middleware('admin');
        // Mostrar recogidas y realizar acciones de recibir y entregar (solo para administradores)
        Route::get('recogidas', [PickPointController::class, 'recogidas'])->name('recogidas')->middleware('admin');
        Route::post('/recibir/{id}', [PickPointController::class, 'recieve'])->name('recieve')->middleware('admin');
        Route::post('/entregar/{id}', [PickPointController::class, 'delive'])->name('delive')->middleware('admin');
        // Mostrar datos en formato datatable (solo para administradores)
        Route::get('/datatable', [PickPointController::class, 'datatable'])->name('datatable')->middleware('admin');



    });
});

require __DIR__ . '/auth.php';

//Auth::routes();
