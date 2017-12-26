@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Estado de Envio
                    </div>

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
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
