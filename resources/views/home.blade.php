@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="h4 panel-heading text-center">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-default" href="producto">Productos</a>
                        <br><br>
                    <a class="btn btn-default" href="envios">Envios</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
