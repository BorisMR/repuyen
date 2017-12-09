@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Control de Productos
                        <!--<div class="text-right"><a href="productos">Lista de Productos</a></div>-->
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
                            <th>Nombre</th>
                            <th><div class="text-center"></div></th>
                        </tr>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>
                                <!--
                                <form method="post" action="producto">
                                    {{ csrf_field() }}
                                    <input value="{{ $producto['id'] }}" hidden>
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>-->
                                {{ Form::open(['url' => 'producto/' . $producto->id, 'class' => 'pull-right']) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Eliminar', [
                                        'class' => 'btn btn-danger'
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