@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
        <br>
        <br>
        <h2 class="text-center">Periodos de Residencias Profesionales</h2>
        <hr>
        <h3>Agregar un nuevo Periodo</h3>
        <br>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="name">Nombre del nuevo Periodo</label>
                        <input type="text" name="" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
