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
                        <form>
                            <div class="form-group">
                                <label>Nombre del residente</label>
                                <input class="form-control" type="text" name="" value="{{$mySinodalia->residente}}">
                            </div>
                            <div class="form-group">
                                <label>Número de control</label>
                                <input class="form-control" type="text" name="" value="{{ $mySinodalia->num_control }}">                       
                            </div>
                            <div class="form-group">
                                <label>Nombre del Proyecto</label>
                                <input class="form-control" type="text" name="" value="{{ $mySinodalia->proyecto }}">                       
                            </div>
                            <div class="form-group">
                                <label>Carrera: </label>
                                <input class="form-control" type="text" name="" value="{{$mySinodalia->carrera}}">
                            </div>
                            <div class="form-group">
                                <label>Presidente:</label>
                                <input class="form-control" type="" name="" value="{{ $presidente }}">
                            </div>
                            <div class="form-group">
                                <label>Secretario:</label>
                                <input class="form-control" type="" name="" value="{{ $secretario }}">
                            </div>
                            <div class="form-group">
                                <label>Vocal: </label>
                                <input class="form-control" type="" name="" value="{{ $vocal }}">
                            </div>
                            <div class="form-group">
                                <label>Vocal Suplente</label>
                                <input class="form-control" type="" name="" value="{{ $vocalsuplente }}">
                            </div>
                            <input class="form-control btn-danger" type="submit" name="" value="Guardar cambios">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    