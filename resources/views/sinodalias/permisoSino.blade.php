@extends('layouts.app')

@section('content')
    <div class="container">
    		<a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
    		<br><br>
        <div class="jumbotron" style="background: red; color: white;">
        	<h1 class="text-center">Solicitud de edición de sinodalía</h1>
        	<br>

        	<div style="font-size: 20px;">
        		<p>Estás a punto de editar la sinodalia #{{ $id }}, solamente el asignador
        		tiene estos privilegios, por esa razón se te pide la contraseña, para comprobar tus derechos.</p>

        		<br>
        		<div class="row justify-content-md-center">
        			<div class="col-md-6">
        			<form action="{{ route("sinoPermisoComp", $id) }}" method="POST">
        				{{-- funcion que provee laravel para generar un token --}}
                {{-- Sin ello, el form no es reconocido por laravel --}}
                {{ csrf_field() }}
        				<div class="form-group">
        					<label for="pass">Contraseña:</label>
        					<input type="password" name="pass" id="pass" class="form-control">
        					<br>
        					<input class="form-control" type="submit" name="" value="Comprobar">
        					@if(session('success'))
                      <div class="alert alert-success" role="alert" style="margin-top: 5px">
                          <span class="text-success">{{ session('success') }}</span>
                      </div>
                  
                  @endif
        				</div>
        			</form>
        		</div>
        		</div>
        	</div>
        </div>
    </div>
@endsection
    