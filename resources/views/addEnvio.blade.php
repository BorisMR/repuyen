@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Envios
                        <div class="text-right"><a href="/home">Dashboard</a></div>
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

                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="envio">
                            {{ csrf_field() }}
                            <h4>PRODUCTO</h4>
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

                            <h4>RECEPTOR</h4>
                            <br>
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                                <label for="rut" class="col-md-4 control-label">Rut</label>
                                <div class="col-md-6">
                                    <input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion" class="col-md-4 control-label">Direccion</label>
                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label for="telefono" class="col-md-4 control-label">Telefono</label>
                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('comentario') ? ' has-error' : '' }}">
                                <label for="comentario" class="col-md-4 control-label">Comentario</label>
                                <div class="col-md-6">
                                    <!--<input id="comentario" type="text" class="form-control" name="comentario" value="{{ old('comentario') }}" required autofocus>-->
                                    <textarea id="comentario" name="comentario" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comprobante" class="col-md-4 control-label">Comprobante</label>
                                <div class="col-md-6">
                                    <p class="help-block">Cargue una imagen del comprobante de deposito</p>
                                    <input data-preview="#preview" name="comprobante" type="file" id="comprobante" hidden="hidden">
                                    <img class="col-sm-6" id="preview"  src="" ></img>
                                </div>
                            </div>

                            <h4>ESTADO</h4>
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <select id="status" name="status" class="form-control" title="Selector de estado" disabled>
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
