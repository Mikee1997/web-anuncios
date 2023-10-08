<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAd;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Http\RedirectResponse;


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

    public function edit($id)
    {
        $anuncio =  Anuncio::find($id);
        return view('formulario_anuncio',compact('anuncio'));
    }

    public function update(RequestAd $request,$id){
        $object=Anuncio::find($id);
        $updated=$object->update($request->only('title', 'short_description', 'long_description', 'phone', 'email'));

        if ($updated) {
            return redirect()->route('ad.edit',$id)->withSuccess(['Anuncio modificado correctamente']);
        } else {
            return redirect()->to(route('ad.edit',$id))->with(['errores' => ['Ocurrió un error al modificar el anuncio']]);

        }
    }

    public function destroy(Request $request,$id)
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $anuncio = Anuncio::find($id);
        $anuncio->delete();


        return redirect()->route('dashboard')->withSuccess(['Anuncio borrado correctamente']);
    }

    public function storeAd(RequestAd $request)
    {

            $anuncio = Anuncio::create($request->only('title', 'short_description', 'long_description', 'phone', 'email') + ['user_id' => auth()->user()->id]);



        if (isset($anuncio)) {
            return redirect()->route('createAd')->withSuccess(['Anuncio creado correctamente']);
        } else {
            return redirect()->to(route('createAd'))->with(['errores' => ['Ocurrió un error al crear el anuncio']]);

        }
    }
}
