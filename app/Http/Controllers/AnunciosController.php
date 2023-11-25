<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAd;
use App\Http\Requests\ReserveRequest;
use App\Mail\EmailReserve;
use App\Models\PickPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;


class AnunciosController extends Controller
{
    // Muestra todos los anuncios publicados en la página inicial
    public function mostrarAnuncios()
    {
        // Obtiene los anuncios publicados y sus imágenes asociadas
        // y los envía a la vista 'anuncios'
        // Las imágenes se obtienen para mostrar la primera como imagen destacada del anuncio
        $anuncios = Anuncio::where('state', 'publicado')->get()->map(function ($anuncio) {
            $imagenes = $anuncio->getMedia('imagenes');
            if (isset($imagenes) && count($imagenes) > 0) {
                $anuncio->imagen = $imagenes[0]->getUrl();
            }
            return $anuncio;
        });

        return view('anuncios', ['anuncios' => $anuncios]);
    }

    // Muestra los detalles de un anuncio específico
    public function detailAd($idAnuncio)
    {
        $anuncio = Anuncio::find($idAnuncio);
        return view('ad.detalle_anuncio', compact('anuncio'));
    }

    //Muestra la pantalla donde el usuario puede ver los anuncios que tiene publicados.
    public function dashboard()
    {
        return view('dashboard', );
    }


    // Muestra el formulario para crear un nuevo anuncio
    public function createAd()
    {
        // Obtiene todos los PickPoints (puntos de recogida) para el formulario
        $pickPoints = PickPoint::all();
        return view('ad.formulario_anuncio', compact('pickPoints'));
    }

    // Muestra el formulario para editar un anuncio existente
    public function edit($id)
    {
        $anuncio = Anuncio::find($id);
        $pickPoints = PickPoint::all();

        return view('ad.formulario_anuncio', compact('anuncio', 'pickPoints'));
    }

    // Actualiza un anuncio existente
    // Actualiza los detalles del anuncio y la imagen asociada, si se proporciona
    // Retorna a la página de edición con un mensaje de éxito o error
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
            return redirect()->route('ad.edit', $id)->withSuccess([__('Successfully modified ad')]);
        } else {
            return redirect()->to(route('ad.edit', $id))->with(['errores' => [__('An error occurred while modifying the ad')]]);

        }
    }

    // Elimina un anuncio

    public function destroy(Request $request, $id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->delete();
        // Elimina el anuncio y redirige al panel de control con un mensaje de éxito
        return redirect()->route('dashboard')->withSuccess([__('Ad successfully deleted')]);
    }

    // Almacena un nuevo anuncio
    // Crea un nuevo anuncio y guarda la imagen asociada, si se proporciona
    // Retorna a la página de creación con un mensaje de éxito o error
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
            return redirect()->route('ad.create')->withSuccess([__('Successfully created ad')]);
        } else {
            return redirect()->to(route('ad.create'))->with(['errores' => [__('An error occurred while creating the ad')]]);

        }
    }

    // Muestra la página de reserva para un anuncio
    // Obtiene los datos necesarios y muestra la página de reserva
    public function reserve($id)
    {
        $anuncio = Anuncio::find($id);
        if ($anuncio->state != 'publicado')
            abort(404);
        $idsPickPoints = json_decode($anuncio->pick_points);
        $pickPoints = PickPoint::whereIn('id', $idsPickPoints)->get();
        return view('ad.reserve', compact('anuncio', 'pickPoints'));
    }

    // Guarda la reserva de un anuncio
    // Guarda la reserva, envía un correo electrónico y muestra la página de agradecimiento
    public function reserveSave(ReserveRequest $request, $id)
    {

        $anuncio = Anuncio::find($id);
        if ($anuncio->state != 'publicado')
            abort(404);
        $anuncio->pickpoint_selected = $request->pickpoint;
        $anuncio->buyer_id = auth()->user()->id;
        $anuncio->state = 'reserved';
        $anuncio->reserved_at = Carbon::now();
        $anuncio->save();

        Mail::to($anuncio->user->email)->send(new EmailReserve($anuncio));

        return view('ad.thanks');
    }

    // Obtiene datos para datatable de anuncios entregados en un PickPoint específico
    // Retorna los datos en formato DataTable para anuncios entregados en un PickPoint
    public function deliveredDatatable($pickpoint)
    {

        $query = Anuncio::where('state', 'delivered')->where('pickpoint_selected', $pickpoint)->withTrashed()->with('buyer')->with('user');

        return DataTables::eloquent($query)
            ->addColumn('buyer', function ($anuncio) {
                return $anuncio->buyer->name;
            })
            ->addColumn('seller', function ($anuncio) {
                return $anuncio->user->name;
            })
            ->filterColumn('buyer', function ($query, $keyword) {
                $query->whereHas('buyer', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
            })
            ->filterColumn('seller', function ($query, $keyword) {
                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
            })
            ->make(true);
    }

    // Obtiene datos para datatable de anuncios reservados en un PickPoint específico
    // Retorna los datos en formato DataTable para anuncios reservados en un PickPoint
    public function reservedDatatable($pickpoint)
    {

        $query = Anuncio::where('state', 'reserved')->where('pickpoint_selected', $pickpoint)->withTrashed()->with('buyer')->with('user');

        return DataTables::eloquent($query)
            ->addColumn('buyer', function ($anuncio) {
                return $anuncio->buyer->name;
            })
            ->addColumn('seller', function ($anuncio) {
                return $anuncio->user->name;
            })
            ->filterColumn('buyer', function ($query, $keyword) {
                $query->whereHas('buyer', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
            })
            ->filterColumn('seller', function ($query, $keyword) {
                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
            })
            ->addColumn('actions', function ($anuncio) {
                return view('pickpoints.partials.buttonRecoger', [
                    'anuncio' => $anuncio,
                ]);
            })
            ->make(true);
    }

    // Obtiene datos para datatable de los propios anuncios del usuario autenticado
    // Retorna los datos en formato DataTable para los anuncios del usuario autenticado
    public function myAdsDatatable()
    {
        $query = Anuncio::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc');

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($anuncio) {
                return view('ad.partials.actions', [
                    'anuncio' => $anuncio,
                ]);
            })
            ->editColumn('created_at', function ($anuncio) {

                return $anuncio->created_at->format('Y-m-d h:i:s');
            })
            ->editColumn('updated_at', function ($anuncio) {

                return $anuncio->created_at->format('Y-m-d h:i:s');
            })
            ->make(true);
    }

    // Obtiene datos para datatable de anuncios pendientes de recogida en un PickPoint específico
    // Retorna los datos en formato DataTable para anuncios pendientes de recogida en un PickPoint
    public function pteDatatable($pickpoint)
    {

        $query = Anuncio::where('state', 'pte-recogida')->where('pickpoint_selected', $pickpoint)->withTrashed()->with('buyer')->with('user');

        return DataTables::eloquent($query)
            ->addColumn('buyer', function ($anuncio) {
                return $anuncio->buyer->name;
            })
            ->addColumn('seller', function ($anuncio) {
                return $anuncio->user->name;
            })
            ->filterColumn('buyer', function ($query, $keyword) {
                $query->whereHas('buyer', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
            })
            ->filterColumn('seller', function ($query, $keyword) {
                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
            })
            ->addColumn('actions', function ($anuncio) {
                return view('pickpoints.partials.buttonEntregar', [
                    'anuncio' => $anuncio,
                ]);
            })
            ->make(true);
    }
}
