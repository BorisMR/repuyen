@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Envios
                    </div>
                    @guest

                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                            </tr>
                            @foreach($envios as $envio)
                                <tr>
                                    <td>{{ $envio['id'] }}</td>
                                    <td>{{ $envio['status'] }}</td>
                                    <td>{{ $envio['created_at'] }}</td>
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
