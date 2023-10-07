<?php

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

Route::get('/', 'HomeController@index', function () {
    return view('welcome');
});

Route::get('/anuncios', [AnuncioController::class, 'mostrarAnuncios']); 