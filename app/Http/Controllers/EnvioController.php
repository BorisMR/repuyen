<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Producto;
use App\Receptor;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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

        $emisor = User::find($id_emisor);

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
        $receptor = Receptor::where('comprobante_deposito', $comprobante)->first();

        $envio = new Envio;

        $envio->id_producto = $id_producto;
        $envio->id_seguimiento = $id_seguimiento;
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
    public function show(Request $request)
    {
        $envio = Envio::find($request->input('id'));

        if (is_null($envio)) {
            return response()->json([], 404);
        }

        $emisor = User::find($envio->id_user);
        $receptor = Receptor::find($envio->id_receptor);

        return view('viewEnvioDetalle')->with('id_envio',$envio->id)
            ->with('status_envio',$envio->id_status)
            ->with('nombre_emisor',$emisor->name)
            ->with('cargo_emisor',$emisor->cargo)
            ->with('rut_receptor',$receptor->id)
            ->with('nombre_receptor',$receptor->nombre)
            ->with('direccion_receptor',$receptor->direccion)
            ->with('fono_receptor',$receptor->telefono)
            ->with('email_receptor',$receptor->email)
            ->with('comprobante',$receptor->comprobante_deposito);
    }

    public function showGuest(Request $id)
    {
        $envioData = Envio::find($id);

        if (is_null($envioData)) {
            return response()->json([], 404);
        }

        //$receptor = Receptor::find($envio[0]['id_receptor']);

        //return response()->json($envio);
        return view('listEnviosGuest')->with('envios', $envioData );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm(Request $request, $id)
    {
        $envios = Envio::find($request->input('id'));

        return view('updateStatusEnvio')->with("envios", $envios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request)
    {
        $envio = Envio::find($request->input('id'));

        $envio->id_status = $request->input('idStatus');

        $envio->save();

        return Redirect::to('envios');
    }

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

        return Redirect::to('envios');
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
        Storage::delete(public_path('comprobantes/').$receptor->comprobante_deposito);
        //dd('no esta borrando imagenes');
        $receptor->delete();

        $envio->delete();

        return Redirect::to('envios');
    }
}
