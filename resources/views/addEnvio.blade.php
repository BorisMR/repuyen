@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Envios
                        <div class="text-right"><a href="envios">Lista de Envios</a></div>
                    </div>
                    @guest

                    <h4>Usted No Se Encuentra Registrado</h4>

                    @else
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="post" action="envio">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('idProducto') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Producto</label>
                                <div class="col-md-6">
                                    <select title="Selector de producto" id="idProducto" name="idProducto" class="form-control">
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto['id'] }}">{{ $producto['nombre'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Autogenerar un ID de seguimiento en controlador, para tracking
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">ID Seguimiento</label>
                                <div class="col-md-6">
                                    <input id="idSeguimiento" type="text" class="form-control" name="idSeguimiento" value="{{ old('idSeguimiento') }}" autofocus>
                                </div>
                            </div>
                            -->
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <select id="status" name="status" class="form-control" title="Selector de estado">
                                        <option value="0" selected>Registrado en sistema</option>
                                        <option value="1">Despachado</option>
                                        <option value="2">En transito</option>
                                        <option value="3">En entrega</option>
                                        <option value="4">Entrega confirmada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Cargar Envío
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
