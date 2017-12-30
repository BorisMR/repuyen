<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Producto;
use App\Receptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $envios = Envio::all();

        return view('listEnvios')->with("envios", $envios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();

        return view('addEnvio')->with("productos", $productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_producto = $request->input('idProducto');
        $id_seguimiento = $request->input('idSeguimiento');
        $status = $request->input('status');
        $id_emisor = Auth::user()->id;


        $producto = Producto::find($id_producto);

        if(!$producto){
            return response()->json([], 404);
        }

        //RECEPTOR
        $nombre = $request->input('nombre');
        $rut = $request->input('rut');
        $direccion = $request->input('direccion');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $comentario = $request->input('comentario');
        $comprobante = $rut.'-'.time().'.'.$request->comprobante->getClientOriginalExtension();
        $request->comprobante->move(public_path('comprobantes'), $comprobante);
        $comprobante_deposito = $comprobante;

        $receptor = new Receptor;

        $receptor->nombre = $nombre;
        $receptor->rut = $rut;
        $receptor->direccion = $direccion;
        $receptor->email = $email;
        $receptor->telefono = $telefono;
        $receptor->comentario = $comentario;
        $receptor->comprobante_deposito = $comprobante_deposito;

        $receptor->save();
        //todo: buscar receptor por rut, si existe proceder a almacenar envio
        $receptor = Receptor::where('comprobante_deposito', $comprobante)->first();

        $envio = new Envio;

        $envio->id_producto = $id_producto;
        $envio->id_seguimiento = $id_seguimiento; //todo: puede ser nula?
        $envio->id_status = empty($status) ? 0 : $status;
        $envio->id_user = $id_emisor; //
        $envio->id_receptor = $receptor->id;

        $envio->save();

        //return response()->json($envio);
        return Redirect::to('envios');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $envios = Envio::find($id);

        if (is_null($envios)) {
            return response()->json([], 404);
        }

        //return response()->json($envio);
        return view('listEnviosGuest')->with("envios", $envios);
    }

    public function showGuest(Request $id)
    {
        $envios = Envio::find($id);

        if (is_null($envios)) {
            return response()->json([], 404);
        }

        //return response()->json($envio);
        return view('listEnviosGuest')->with('envios', $envios);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $envio = Envio::find($id);

        if(!$envio) {
            return response()->json([], 404);
        }

        $receptor = $envio->id_receptor;
        $receptor = Receptor::find($receptor);
        //todo: borrar comprobante
        $receptor->delete();

        $envio->delete();

        return Redirect::to('envios');
    }
}
