@extends('layouts.app')

@section('content')
  <div class="container">
  	<h2>Formulario de edición de Usuario: {{ $user->name }}</h2>
  	<a class="btn btn-primary" href="/teachersPanel">Atrás</a>
  	<br>
  	<hr>
  	<div class="row">
  		<div class="col-md-6">
  			<form>
  				<div class="form-group">
  					<label>Nombre: </label>
  					<input type="text" class="form-control" value="{{ $user->name }}"></input>
  				</div>
  				<div class="form-group">
  					<label>Número de control: </label>
  					<input type="text" class="form-control" value="{{ $user->num_control }}"></input>
  				</div>
  				<div class="form-group">
  					<label>Telefono celular: </label>
  					<input type="text" class="form-control" value="{{ $user->telefono }}"></input>
  				</div>
  				<div class="form-group">
  					<label>Cargo: </label>
  					<select class="form-control">
  						<option>Asignador</option>
  						<option>Profesorado</option>
  						<option>Aministrativo</option>
  					</select>
  				</div>
  			</form>
  		</div>
  	</div>
  </div>
@endsection
