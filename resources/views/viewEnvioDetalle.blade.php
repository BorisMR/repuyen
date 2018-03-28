@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detalle de Envio
                        <div class="text-right"><a href="/home">Dashboard</a></div>
                        <div class="text-right"><a href="/envios">Lista Envios</a></div>
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
                                    <td><b>ID Envio</b></td>
                                    <td>{{ $id_envio }}</td>
                                </tr>
                                <tr>
                                    <td><b>Status Envio</b></td>
                                    <td>@if (($status_envio) == 0)
                                            Registrado en sistema
                                        @elseif (($status_envio) == 1)
                                            Despachado
                                        @elseif (($status_envio) == 2)
                                            En transito
                                        @elseif (($status_envio) == 3)
                                            En entrega
                                        @elseif (($status_envio) == 4)
                                            Entrega confirmada
                                        @else
                                            INDETERMINADO
                                        @endif</td>
                                </tr>
                                <tr>
                                    <td><b>Creador de Envio</b></td>
                                    <td>{{ $nombre_emisor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Cargo del Creador</b></td>
                                    <td>{{ $cargo_emisor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Rut Receptor</b></td>
                                    <td>{{ $rut_receptor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Nombre Receptor</b></td>
                                    <td>{{ $nombre_receptor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Dirección Receptor</b></td>
                                    <td>{{ $direccion_receptor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Fono Receptor</b></td>
                                    <td>{{ $fono_receptor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Email Receptor</b></td>
                                    <td>{{ $email_receptor }}</td>
                                </tr>
                                <tr>
                                    <td><b>Comprobante de Pago</b></td>
                                    <td><img class="img-responsive" src="../comprobantes/{{ $comprobante }}"></td>
                                </tr>
                            </table>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection