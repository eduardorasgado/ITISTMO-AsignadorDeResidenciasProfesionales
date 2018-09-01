@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a class="btn btn-primary" href="{{ '/home' }}">Atrás</a>
        <br><hr>
        <h2>Residencia profesional: Vista unitaria sinodal #{{$mySinodalia->id}}</h2>
        <br><br>
        <div class="card">
            <div class="card-header">
                <h3 style="display: inline; margin-right:20px;">Residente: {{ $mySinodalia->residente }}</h3> 
                <a class="btn btn-danger" href="{{route("permisoEditar", $mySinodalia->id)}}">Editar</a>
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
                    <b>Aprobación Anteproyecto: </b>
                    <div class="row">
                        <div class="col-md-3">
                            <p>{{ $mySinodalia->proyecto_aprobacion == 1 ? "APROBADO" : "Aún sin Aprobar"  }}</p>
                        </div>
                        <div class="col-md-3">
                             @if($mySinodalia->proyecto_aprobacion != 1)
                                <form action="{{ route("sinoPermisoComp2", $mySinodalia->id) }}" method="POST">
                                    {{-- funcion que provee laravel para generar un token --}}
                                    {{-- Sin ello, el form no es reconocido por laravel --}}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="pass">Contraseña:</label>
                                        <input type="password" name="pass" id="pass" class="form-control">
                                    </div>
                                    <input class="form-control btn btn-success" type="submit" name="" value="Aprobar anteproyecto">
                                    @if(session('success'))
                                      <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                          <span class="text-success">{{ session('success') }}</span>
                                      </div>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>

                    @if($mySinodalia->proyecto_aprobacion == 1)
                        <b>Aprobación Final: </b>

                    @endif
                    @if($mySinodalia->proyecto_aprobacion == 1)
                    <div class="row">
                        <div class="col-md-3">
                            @if($mySinodalia->aprobacion == 1)
                            <p>APROBADO</p>
                            @else
                                <p>Aún sin Aprobar</p>
                            @endif  
                        </div>
                        <div class="col-md-2">
                            @if($mySinodalia->aprobacion != 1)
                                <a href="{{route("permisoEditar", $mySinodalia->id)}}" class="btn btn-success">Aprobar Proyecto</a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
    