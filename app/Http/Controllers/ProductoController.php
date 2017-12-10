<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        //return response()->json($productos);

        return view('listProducts')->with("productos", $productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $producto = Producto::where('nombre', $nombre)->first();

        if(!is_null($producto)) {
            return response()->json([
                'errors' => [
                    'code' => 409,
                    'detail' => 'El producto ya existe'
                ]
            ], 409);
        }

        $producto = new Producto;

        $producto->nombre = $nombre;

        $producto->save();

        return response()->json($producto);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        if (is_null($producto)) {
            return response()->json([], 404);
        }

        return response()->json($producto);
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
        $producto = Producto::find($id);

        if(!$producto) {
            return response()->json([], 404);
        }

        $producto->delete();

        return Redirect::to('productos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addProduct');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /*NOT USED
    public function findByName(Request $request){
        $producto = Producto::where('nombre', $request->input('nombre'))->first();

        if (is_null($producto)) {
            return response()->json([], 404);
        }

        return response()->json($producto);
    }
    */
}
