@extends('layouts.app')

@section('content')
  <div class="container">
  	<h2>Formulario de edición de Usuario: {{ $user->name }}</h2>
  	<a class="btn btn-primary" href="/teachersPanel">Atrás</a>
  	<br>
  	<hr>
  	<div class="row">
  		<div class="col-md-6">
  			<form action="{{ url('/editarTeacher/update') }}" method="POST"
                    onsubmit="return confirm('Estás realmente seguro/a de modificar este integrante?');">
                {{-- funcion que provee laravel para generar un token --}}
	              {{-- Sin ello, el form no es reconocido por laravel --}}
	              {{ csrf_field() }}
	            
	            <input type="hidden" name="idTeacher" id="idTeacher" value="{{ $user->id }}">
  				
  				<div class="form-group">
  					<label for="name">Nombre: </label>
  					<input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}"></input>
  				</div>
  				<div class="form-group">
  					<label for="num_control">Número de control: </label>
  					<input type="text" class="form-control" name="num_control" id="num_control" value="{{ $user->num_control }}"></input>
  				</div>
  				<div class="form-group">
  					<label for="telefono">Telefono celular: </label>
  					<input type="text" class="form-control" name="telefono" id="telefono" value="{{ $user->telefono }}"></input>
  				</div>
  				<div class="form-group">
  					<label for="cargo">Cargo: </label>
  					<select class="form-control" name="cargo" id="cargo">
  						<option value="0" {{ ($user->cargo == 0) ? 'selected' : '' }}>Asignador</option>
  						<option value="2" {{ ($user->cargo == 2) ? 'selected' : '' }}>Profesorado</option>
  						<option value="1" {{ ($user->cargo == 1) ? 'selected' : '' }}>Aministrativo</option>
  					</select>
  				</div>
  				<input class="form-control btn btn-danger" type="submit" name="guardar" value="Guardar cambios">
  			</form>
  		</div>
  	</div>
  </div>
@endsection
