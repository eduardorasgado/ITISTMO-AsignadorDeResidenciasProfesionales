@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
        <br><hr>
        <h2>Residencia profesional: Vista unitaria sinodal #{{$mySinodalia->id}}</h2>
        <br><br>
        <div class="card">
            <div class="card-header">
                <h3>Residente: {{ $mySinodalia->residente }}</h3>
            </div>
            <div class="card-body" style="font-size: 20px">
                <b>Nombre del residente</b><p>{{$mySinodalia->residente}}</p>
                <b>Número de control</b><p>{{ $mySinodalia->num_control }}</p>
                <b>Nombre de proyecto</b><p>{{$mySinodalia->proyecto}}</p>
                <b>Carrera: </b><p>{{$mySinodalia->carrera}}</p>              
                <b>Presidente: </b><p>{{ $presidente }}</p>
                <b>Secretario: </b><p>{{ $secretario }}</p>
                <b>Vocal: </b><p>{{ $vocal }}</p>
                <b>Vocal Suplente: </b><p>{{ $vocalsuplente }}</p>
                <br>
                <div class="jumbotron" style="background: orange; color: white">
                    <h3 class="text-center">Aprobaciones Oficiales del Sinodal</h3>
                    <b>Aprobación Anteproyecto: </b><p>{{ $mySinodalia->proyecto_aprobacion == 1 ? "APROBADO" : "Aún sin Aprobar"  }}</p>
                    @if($mySinodalia->proyecto_aprobacion == 1)
                        <b>Aprobacion final: </b>

                    @endif
                    @if($mySinodalia->proyecto_aprobacion == 1)
                        @if($mySinodalia->aprobacion == 1)
                            <p>APROBADO</p>
                        @else
                            <p>Aún sin Aprobar</p>
                        @endif   
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
    