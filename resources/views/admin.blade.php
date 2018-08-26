@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hola Asignador, bienvenido.</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Este es tu dashboard, aquí puedes trabajar con todas las asignaciones,
                    es privado y sólo tú lo puedes ver.
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="{{ route('nuevoPeriodo') }}">Periodos</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="">Historial</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="">Gráficas</a>
        </div>
    </div>
    <!--React component-->
    <div id="Index"></div>
</div>


@endsection
