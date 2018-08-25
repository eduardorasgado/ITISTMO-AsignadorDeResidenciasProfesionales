@extends('layouts.app')

@section('content')
<div class="container">
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

                    Estás en linea
                </div>
            </div>
        </div>
    </div>
    <!--React component-->
    <div id="Index"></div>
</div>
@endsection
