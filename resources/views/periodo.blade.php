@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
        <br>
        <br>
        <h2 class="text-center">Periodos de Residencias Profesionales</h2>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h3>Agregar un nuevo Periodo</h3>
                <form action="{{ url('/periodo/create') }}" method="POST">
                    <div class="form-group">
                         {{-- funcion que provee laravel para generar un token --}}
                          {{-- Sin ello, el form no es reconocido por laravel --}}
                          {{ csrf_field() }}
                        <label for="name">Nombre del nuevo Periodo</label>
                        <input id="name" type="text" name="name" class="form-control" required>
                    </div>
                    <input class="btn btn-primary" type="submit" name="" value="Crear">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert" style="margin-top: 5px">
                            <span class="text-success">{{ session('success') }}</span>
                        </div>
                        
                    @endif
                </form>
            </div>
            <div class="col-md-6">
                <h3 className="text-center">Historial de Periodos</h3>
                <div id="PeriodosIndex"></div>
            </div>
        </div>
    </div>
@endsection