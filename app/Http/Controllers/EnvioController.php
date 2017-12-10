<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Producto;
use App\Seguimiento;
use Illuminate\Http\Request;
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

        $producto = Producto::find($id_producto);

        if(!$producto){
            return response()->json([], 404);
        }

        $envio = new Envio;

        $envio->id_producto = $id_producto;
        $envio->id_seguimiento = $id_seguimiento;
        $envio->status = empty($status) ? 0 : $status;

        $envio->save();

        return response()->json($envio);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $envio = Envio::find($id);

        if (is_null($envio)) {
            return response()->json([], 404);
        }

        return response()->json($envio);
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

        $envio->delete();

        return Redirect::to('envios');
    }
}
