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
                <h3 style="display: inline; margin-right:20px;">Residente: {{ $mySinodalia->residente }}</h3> 
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
            </div>
        </div>
    </div>
@endsection
    