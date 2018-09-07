@extends('layouts.app')

@section('content')
    <div class="container">
    	<h2 class="text-center">Profesorado perteneciente a la academia</h2>
    	<a class="btn btn-primary" href="{{ URL::previous() != url()->current() ? URL::previous() : "/home" }}">Atrás</a>
    	<br>
    	<hr>
    	<div class="row justify-content-md-center">
    	@foreach($users as $user)
  			<div class="col-md-6" style="padding: 20px; font-size: 1.2em">

  				<h3 class="alert alert-dark">{{ $user->name }} 
  					<a style="margin-left: 20px;
  										margin-right: 20px;" 
  										class="btn btn-primary" href="">Editar</a>
  					<a class="btn btn-danger" href="">Eliminar</a>
  				</h3>

  				<div class="alert alert-primary">
  					<b>Número de Control: </b><p>{{ $user->num_control }}</p>
    				<b>Número de sinodalías registradas y activas:</b><p>{{$user->num_asignaciones}} sinodalía(s)</p>
    				<b>Telefono celular: </b><p>{{ $user->telefono }}</p>
    				<b>Cargo: </b>
    					@if($user->cargo == 0)
    						<p>Asignador</p>
    					@elseif($user->cargo == 1)
    						<p>Administrativo</p>
    					@elseif($user->cargo == 2)
    						<p>Profesorado</p>
    					@endif
  				</div>
  				
  			</div>    			  
	    @endforeach
	    </div>
    </div>
@endsection
