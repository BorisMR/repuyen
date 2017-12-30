@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Productos
                        <div class="text-right"><a href="productos">Lista de Productos</a></div>
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

                        <form class="form-horizontal" method="post" action="producto">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                                <div class="col-md-6">
                                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Agregar
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
