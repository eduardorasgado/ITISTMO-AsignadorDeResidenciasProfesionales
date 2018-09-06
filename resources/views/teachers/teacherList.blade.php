@extends('layouts.app')

@section('content')
    <div class="container">
    	<h2 class="text-center">Profesorado perteneciente a la academia</h2>
    	<br>
    	<hr>
    	@foreach($users as $user)
	    	<div class="" style="padding: 20px; font-size: 1.2em">
	    		
	    		<div class="row justify-content-md-center">
	    			<div class="col-md-6">
	    				<h3 class="alert alert-dark">{{ $user->name }}</h3>
	    				<div class="alert alert-primary">
	    					<b>Número de Control: </b><p>{{ $user->num_control }}</p>
		    				<b>Número de sinodalías registradas y activas:</b><p>{{$user->num_asignaciones}} sinodalía(s)</p>
		    				<b>Telefono celular: </b><p>{{ $user->telefono }}</p>
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				
	    				<br><br><br>
	    				<a style="margin-right: 20px;" class="btn btn-primary" href="">Editar</a>
	    				<a class="btn btn-danger" href="">Eliminar</a>
	    			</div>
	    		</div>
	    	</div>
	    	<hr>
	    @endforeach
    </div>
@endsection
