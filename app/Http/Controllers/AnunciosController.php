<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anuncio;

class AnunciosController extends Controller
{
    public function mostrarAnuncios()
    {
        $anuncios = Anuncio::all();
        return view('anuncios', ['anuncios' => $anuncios]);
    }

    public function crearAnuncio()
    {
        return view('formulario_anuncio');
    }
}
