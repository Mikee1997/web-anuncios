<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPickPoint;
use App\Models\PickPoint;
use Illuminate\Http\Request;

class PickPointController extends Controller
{
    public function index(){
        $pickPoints=PickPoint::all();
        return view("pickpoints.index",compact("pickPoints"));
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
            return redirect()->route('pickPoints.edit',$pickPoint->id)->withSuccess(['Punto de recogida creado correctamente']);
        } else {
            return redirect()->to(route('pickPoints.create'))->with(['errores' => ['Ocurrió un error al crear el punto de recogida']]);

        }
    }
}
