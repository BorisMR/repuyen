@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Envios
                        <div class="text-right"><a href="{{ url('/home') }}">Dashboard</a></div>
                        <div class="text-right"><a href="{{ url('/envios') }}">Lista de Envios</a></div>
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
                        <form class="form-control" method="POST" action="{{ url('/status') }}">
                            {{ csrf_field() }}
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Modificación</th>
                                    <th>Estado</th>
                                </tr>
                                <tr>
                                @foreach($envios as $envio)

                                        <td>{{ $envios['id'] }}</td>
                                        <td>{{ $envios['created_at'] }}</td>
                                        <td>{{ $envios['updated_at'] }}</td>
                                        <td>
                                            <select id="status" name="idStatus" id="idStatus" class="form-control" title="Selector de estado">
                                            @if (($envios['id_status']) == 0)
                                                <option value="0" selected>Registrado en sistema</option>
                                                <option value="1">Despachado</option>
                                                <option value="2">En transito</option>
                                                <option value="3">En entrega</option>
                                                <option value="4">Entrega confirmada</option>
                                                @break
                                            @elseif (($envios['id_status']) == 1)
                                                <option value="0">Registrado en sistema</option>
                                                <option value="1" selected>Despachado</option>
                                                <option value="2">En transito</option>
                                                <option value="3">En entrega</option>
                                                <option value="4">Entrega confirmada</option>
                                                @break
                                            @elseif (($envios['id_status']) == 2)
                                                <option value="0">Registrado en sistema</option>
                                                <option value="1">Despachado</option>
                                                <option value="2" selected>En transito</option>
                                                <option value="3">En entrega</option>
                                                <option value="4">Entrega confirmada</option>
                                                @break
                                            @elseif (($envios['id_status']) == 3)
                                                <option value="0">Registrado en sistema</option>
                                                <option value="1">Despachado</option>
                                                <option value="2">En transito</option>
                                                <option value="3" selected>En entrega</option>
                                                <option value="4">Entrega confirmada</option>
                                                @break
                                            @elseif (($envios['id_status']) == 4)
                                                <option value="0">Registrado en sistema</option>
                                                <option value="1">Despachado</option>
                                                <option value="2">En transito</option>
                                                <option value="3">En entrega</option>
                                                <option value="4" selected>Entrega confirmada</option>
                                                @break
                                            @else
                                                INDETERMINADO
                                            @endif
                                        </select>
                                        </td>
                                @endforeach
                                </tr>
                            </table>
                            <br>
                            <input id="id" name="id" value="{{ $envios['id'] }}" hidden>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Estado
                                    </button>
                                </div>
                                <div class="col-md-6 col-md-offset-4">
                                    <br>
                                    <a class="btn btn-info btn-sm" href="{{ url('/envios') }}">
                                        Cancelar
                                    </a>
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
