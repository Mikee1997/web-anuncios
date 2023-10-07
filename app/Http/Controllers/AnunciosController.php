<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAd;
use Illuminate\Http\Request;
use App\Models\Anuncio;

class AnunciosController extends Controller
{
    public function mostrarAnuncios()
    {
        $anuncios = Anuncio::all();
        return view('anuncios', ['anuncios' => $anuncios]);
    }

    public function detailAd($idAnuncio)
    {
        $anuncio = Anuncio::find($idAnuncio);
        return view('detalle_anuncio', compact('anuncio'));
    }

    public function createAd()
    {
        return view('formulario_anuncio');
    }

    public function storeAd(RequestAd $request)
    {

            $anuncio = Anuncio::create($request->only('title', 'short_description', 'long_description', 'phone', 'email') + ['user_id' => 1]);



        if (isset($anuncio)) {
            return redirect()->route('createAd')->withSuccess(['Anuncio creado correctamente']);
        } else {
            return redirect()->to(route('createAd'))->with(['errores' => ['Ocurrió un error al crear el anuncio']]);

        }
    }
}
