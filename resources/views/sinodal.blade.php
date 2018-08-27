@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
        <br><hr>
        <h2>Residencia profesional: Vista unitaria #{{"hola"}}</h2>
        {{ $mySinodalia }}
    </div>
@endsection
    