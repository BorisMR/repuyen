<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Producto;
use App\Seguimiento;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $envios = Envio::all();

        return response()->json($envios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_producto = $request->input('idProducto');
        $id_seguimiento = $request->input('idSeguimiento');

        $producto = Producto::find($id_producto);

        if(!$producto){
            return response()->json([], 404);
        }

        $seguimiento = Seguimiento::find($id_seguimiento);

        if(!is_null($seguimiento)){
            $envio = Envio::create([
                'id_producto' => $request->input('idProducto'),
                'id_seguimiento' => $request->input('idSeguimiento'),
                'status' => $request->input('')
            ]);
        }else{
            $envio = Envio::create([
                'id_producto' => $request->input('idProducto'),
                'id_seguimiento' => $request->input(''),
                'id_status' => 0 //definir estados
            ]);
        }

        return response()->json($envio);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $envio = Envio::find($id);

        if (!$envio) {
            return response()->json([], 404);
        }

        return response()->json($envio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
