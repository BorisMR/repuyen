<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Receptor;
use Illuminate\Http\Request;

class ReceptorController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function updateReceptor(Request $request, $id)
    {
        $envio = Envio::find($id);

        $receptor = Receptor::find($envio->id_receptor);

        $receptor->nombre = $request->input('nombre');
        $receptor->rut = $request->input('rut');
        $receptor->direccion = $request->input('direccion');
        $receptor->email = $request->input('email');
        $receptor->telefono = $request->input('telefono');
        $receptor->comentario = $request->input('comentario');

        if($receptor->comprobante_deposito != $request->comprobante){
            $comprobante = $receptor->rut.'-'.time().'.'.$request->comprobante->getClientOriginalExtension();
            $request->comprobante->move(public_path('comprobantes'), $comprobante);
            $receptor->comprobante_deposito = $comprobante;
        }

        $receptor->save();
    }
}
