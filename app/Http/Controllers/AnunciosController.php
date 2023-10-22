<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAd;
use App\Http\Requests\ReserveRequest;
use App\Models\PickPoint;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;


class AnunciosController extends Controller
{
    public function mostrarAnuncios()
    {
        $anuncios = Anuncio::all()->map(function ($anuncio) {
            $imagenes = $anuncio->getMedia('imagenes');
            if (isset($imagenes) && count($imagenes) > 0) {
                $anuncio->imagen = $imagenes[0]->getUrl();
            }
            return $anuncio;
        });

        return view('anuncios', ['anuncios' => $anuncios]);
    }

    public function detailAd($idAnuncio)
    {
        $anuncio = Anuncio::find($idAnuncio);
        return view('ad.detalle_anuncio', compact('anuncio'));
    }

    public function createAd()
    {
        $pickPoints = PickPoint::all();
        return view('formulario_anuncio', compact('pickPoints'));
    }

    public function edit($id)
    {
        $anuncio = Anuncio::find($id);
        $pickPoints = PickPoint::all();

        return view('formulario_anuncio', compact('anuncio', 'pickPoints'));
    }

    public function update(RequestAd $request, $id)
    {
        $pickPoints = json_encode(array_keys($request->pickpoint));
        $object = Anuncio::find($id);
        $updated = $object->update($request->only('title', 'short_description', 'long_description', 'phone', 'email') + ['pick_points' => $pickPoints]);

        if ($request->has('image')) {
            foreach ($object->getMedia('imagenes') as $media) {
                $media->delete();
            }
            $object
                ->addMedia($request->file('image')) // Agrega la imagen al modelo
                ->toMediaCollection('imagenes');
        }
        if (isset($request->delete_image) && $request->delete_image == 'on') {
            foreach ($object->getMedia('imagenes') as $media) {
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
        $pickPoints = json_encode(array_keys($request->pickpoint));


        $anuncio = Anuncio::create($request->only('title', 'short_description', 'long_description', 'phone', 'email') + ['user_id' => auth()->user()->id, 'pick_points' => $pickPoints, 'state' => 'publicado']);

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

    public function reserve($id)
    {
        $anuncio = Anuncio::find($id);
        $idsPickPoints = json_decode($anuncio->pick_points);
        $pickPoints = PickPoint::whereIn('id', $idsPickPoints)->get();
        return view('ad.reserve', compact('anuncio', 'pickPoints'));
    }

    public function reserveSave(ReserveRequest $request, $id){
        $anuncio = Anuncio::find($id);
        $anuncio->pickpoint_selected=$request->pickpoint;
        $anuncio->buyer_id=auth()->user()->id;
        $anuncio->state='reserved';
        $anuncio->save();

        Mail::to($anuncio->user()->email)->send(new EmailReserve($anuncio));

        return view('ad.thanks');
    }
}
