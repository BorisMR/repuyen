@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Envios
                        <div class="text-right"><a href="{{ url('/home') }}">Dashboard</a></div>
                        <div class="text-right"><a href="{{ url('/envio') }}">Generar Envio</a></div>
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
                            <div>
                                <h3>Buscar Envio</h3>

                                <form class="form-horizontal" method="post" action="enviofind">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('idProducto') ? ' has-error' : '' }}">
                                        <label for="id" class="col-md-4 control-label">ID ENVIO</label>
                                        <div class="col-md-6">
                                            <input id="id" class="form-control" name="id" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-info">
                                                Buscar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <br>
                        <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Fecha de Creación</th>
                            <th>Fecha de Modificación</th>
                            <th>Opciones</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($envios as $envio)
                        <tr>
                            <td>{{ $envio['id'] }}</td>
                            <td>
                                @if (($envio->id_status) == 0)
                                    Registrado en sistema
                                @elseif (($envio->id_status) == 1)
                                    Despachado
                                @elseif (($envio->id_status) == 2)
                                    En transito
                                @elseif (($envio->id_status) == 3)
                                    En entrega
                                @elseif (($envio->id_status) == 4)
                                    Entrega confirmada
                                @else
                                    INDETERMINADO
                                @endif
                            </td>
                            <td>{{ $envio['created_at'] }}</td>
                            <td>{{ $envio['updated_at'] }}</td>
                            <td>
                                {{ Form::open(['url' => 'envioStatus/' . $envio->id, 'class' => 'pull-right', 'method' => 'POST']) }}
                                {{ Form::hidden('id', $envio->id) }}
                                {{ Form::button('<span class="glyphicon glyphicon-edit">&nbsp;Estado</span>', [
                                    'class' => 'btn btn-success',
                                    'type' => 'submit'
                                    ]) }}
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['url' => 'envio/' . $envio->id, 'class' => 'pull-right', 'method' => 'GET']) }}
                                {{ Form::hidden('id', $envio->id) }}
                                {{ Form::hidden('id_receptor', $envio->id_receptor) }}
                                {{ Form::button('<span class="glyphicon glyphicon-zoom-in"></span>', [
                                    'class' => 'btn btn-primary',
                                    'type' => 'submit'
                                    ]) }}
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['url' => 'envio/' . $envio->id, 'class' => 'pull-right']) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::button('<span class="glyphicon glyphicon-trash"></span>', [
                                    'class' => 'btn btn-danger',
                                    'type' => 'submit'
                                    ]) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                        </table>

                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
