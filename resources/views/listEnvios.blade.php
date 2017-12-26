@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Envios
                        <div class="text-right"><a href="envio">Generar Envio</a></div>
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

                        <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Fecha de Creación</th>
                            <th></th>
                        </tr>
                        @foreach($envios as $envio)
                        <tr>
                            <td>{{ $envio['id'] }}</td>
                            <td>{{ $envio['status'] }}</td>
                            <td>{{ $envio['created_at'] }}</td>
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
