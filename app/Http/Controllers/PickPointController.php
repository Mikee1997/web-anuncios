<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPickPoint;
use App\Mail\EmailDelivered;
use App\Mail\EmailRecieve;
use App\Models\Anuncio;
use App\Models\PickPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class PickPointController extends Controller
{
    public function index()
    {
        return view("pickpoints.index");
    }

    public function datatable() {
        $query = PickPoint::query();

        return DataTables::eloquent($query)
            ->addColumn('actions',function($pickPoint){
                return view('pickpoints.partials.actions', [
                    'pickPoint' => $pickPoint,
                ]);
            })
            ->editColumn('created_at',function($pickpoint){

                return $pickpoint->created_at->format('Y-m-d h:i:s');
            })
            ->make(true);
    }

    public function create()
    {
        return view('pickpoints.formulario_pick_point');
    }

    public function edit($id)
    {
        $pickPoint = PickPoint::find($id);
        return view('pickpoints.formulario_pick_point', compact('pickPoint'));
    }

    public function update(RequestPickPoint $request, $id)
    {
        $object = PickPoint::find($id);
        $updated = $object->update($request->only('name', 'direccion'));


        if ($updated) {
            return redirect()->route('pickPoints.edit', $id)->withSuccess(['Punto de recogida modificado correctamente']);
        } else {
            return redirect()->to(route('pickPoints.edit', $id))->with(['errores' => ['Ocurrió un error al modificar el punto de recogida']]);

        }
    }

    public function destroy(Request $request, $id)
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $pickPoint = PickPoint::find($id);
        $pickPoint->delete();


        return redirect()->route('pickPoints.index')->withSuccess(['Punto de recogida borrado correctamente']);
    }

    public function store(RequestPickPoint $request)
    {

        $pickPoint = PickPoint::create($request->only('name', 'direccion'));




        if (isset($pickPoint)) {
            return redirect()->route('pickPoints.edit', $pickPoint->id)->withSuccess(['Punto de recogida creado correctamente']);
        } else {
            return redirect()->to(route('pickPoints.create'))->with(['errores' => ['Ocurrió un error al crear el punto de recogida']]);

        }
    }

    public function recogidas(Request $request)
    {
        $pickPoints = PickPoint::all();
        if($request->has('pickpoint')){
            $pickpoint=$request->pickpoint;
        }else{
            $pickpoint=$pickPoints->first()->id;
        }



        return view('pickpoints.recogidas', compact('pickPoints')+['selectedPickPoint'=>$pickpoint]);
    }



    public function recieve(Request $request, $id)
    {
        $anuncio = Anuncio::find($id);
        if ($anuncio->state != 'reserved')
            abort(404);
        $anuncio->state = 'pte-recogida';
        $anuncio->available_at = Carbon::now();
        $anuncio->save();
        Mail::to($anuncio->buyer->email)->send(new EmailRecieve($anuncio));

        return redirect()->route('pickPoints.recogidas')->withSuccess(['El articulo ha sido recibido']);
    }

    public function delive(Request $request, $id)
    {
        $anuncio = Anuncio::find($id);
        if ($anuncio->state != 'pte-recogida')
            abort(404);
        $anuncio->state = 'delivered';
        $anuncio->dalivered_at = Carbon::now();
        $anuncio->save();
        Mail::to($anuncio->user->email)->send(new EmailDelivered($anuncio));

        return redirect()->route('pickPoints.recogidas')->withSuccess(['El articulo ha sido entregado']);
    }
}
