@extends('layouts.app')

@section('content')
  <div class="container">
        <br>
        <a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
        <br><hr>
        <h2>Residencia profesional: Edición de sinodal #{{$mySinodalia->id}}</h2>
        <br><br>
        <div class="card">
            <div class="card-header">
                <h3 style="display: inline; margin-right:20px;">Residente: {{ $mySinodalia->residente }}</h3> 
            </div>
            <div class="card-body" style="font-size: 20px">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route("updateSino", $mySinodalia->id) }}" method="POST">
                            {{-- funcion que provee laravel para generar un token --}}
                            {{-- Sin ello, el form no es reconocido por laravel --}}
                            {{ csrf_field() }}
                            <input type="hidden" name="id2" id="id2" value="{{ $mySinodalia->id }}">
                            <div class="form-group">
                                <label for="residente">Nombre del residente</label>
                                <input class="form-control" type="text" id="residente" name="residente" value="{{$mySinodalia->residente}}">
                            </div>
                            <div class="form-group">
                                <label for="num_control">Número de control</label>
                                <input class="form-control" type="text" id="num_control" name="num_control" value="{{ $mySinodalia->num_control }}">                       
                            </div>
                            <div class="form-group">
                                <label for="proyecto">Nombre del Proyecto</label>
                                <input class="form-control" type="text" id="proyecto" name="proyecto" value="{{ $mySinodalia->proyecto }}">                       
                            </div>
                            <div class="form-group">
                                <label for="carrera">Carrera: </label>
                                <input class="form-control" type="text" id="carrera" name="carrera" value="{{$mySinodalia->carrera}}">
                            </div>
                            <div class="form-group">
                                <label for="presidente">Presidente:</label>
                                <select class="form-control" id="presidente" name="presidente">
                                        <option value="{{ $presidente->id }}">{{ $presidente->name }}</option>
                                        @foreach ($allTeachers as $teacher)
                                            @if($teacher->id != $presidente->id)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="secretario">Secretario:</label>
                                <select class="form-control" id="secretario" name="secretario">
                                        <option value="{{ $secretario->id }}">{{ $secretario->name }}</option>
                                        @foreach ($allTeachers as $teacher)
                                            @if($teacher->id != $secretario->id)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vocal">Vocal: </label>
                                <select class="form-control" id="vocal" name="vocal">
                                        <option value="{{ $vocal->id }}">{{ $vocal->name }}</option>
                                        @foreach ($allTeachers as $teacher)
                                            @if($teacher->id != $vocal->id)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vocalSuplente">Vocal Suplente</label>
                                <select class="form-control" id="vocalsuplente" name="vocalsuplente">
                                        <option value="{{ $vocalsuplente->id }}">{{ $vocalsuplente->name }}</option>
                                        @foreach ($allTeachers as $teacher)
                                            @if($teacher->id != $vocalsuplente->id)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <input class="form-control btn-danger" type="submit" name="" value="Guardar cambios">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    