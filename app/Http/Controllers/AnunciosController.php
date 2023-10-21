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
        $anuncios = Anuncio::all()->map(function($anuncio){
            $imagenes = $anuncio->getMedia('imagenes');
            if(isset($imagenes)&&count($imagenes)>0){
                $anuncio->imagen=$imagenes[0]->getUrl();
            }
            return $anuncio;
        });

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
        $anuncio = Anuncio::find($id);
        return view('formulario_anuncio', compact('anuncio'));
    }

    public function update(RequestAd $request, $id)
    {
        $object = Anuncio::find($id);
        $updated = $object->update($request->only('title', 'short_description', 'long_description', 'phone', 'email'));

        if($request->has('image')){
            foreach($object->getMedia('imagenes') as $media){
                $media->delete();
            }
            $object
                ->addMedia($request->file('image')) // Agrega la imagen al modelo
                ->toMediaCollection('imagenes');
        }
        if(isset($request->delete_image)&&$request->delete_image=='on'){
            foreach($object->getMedia('imagenes') as $media){
                $media->delete();
            }
        }

        if ($updated) {
            return redirect()->route('ad.edit', $id)->withSuccess(['Anuncio modificado correctamente']);
        } else {
            return redirect()->to(route('ad.edit', $id))->with(['errores' => ['Ocurrió un error al modificar el anuncio']]);

        }
    }

    public function destroy(Request $request, $id)
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

        if ($request->has('image')) {
            $anuncio
                ->addMedia($request->file('image')) // Agrega la imagen al modelo
                ->toMediaCollection('imagenes');
        }


        if (isset($anuncio)) {
            return redirect()->route('ad.create')->withSuccess(['Anuncio creado correctamente']);
        } else {
            return redirect()->to(route('ad.create'))->with(['errores' => ['Ocurrió un error al crear el anuncio']]);

        }
    }
}
