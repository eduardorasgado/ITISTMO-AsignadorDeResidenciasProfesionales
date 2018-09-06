@extends('layouts.app')

@section('content')
    <div class="container">
    	<h2 class="text-center">Profesorado perteneciente a la academia</h2>
    	<br>
    	@foreach($users as $user)
	    	<div class="jumbotron" style="background: #333333; color: white; padding: 20px;">
	    		
	    		<div class="row justify-content-md-center">
	    			<div class="col-md-6">
	    				<h4 class="text-center">{{ $user->name }}</h4>
	    				<b>Número de Control: </b><p>{{ $user->num_control }}</p>
	    				<b>Número de sinodalías registradas y activas:</b><p>{{$user->num_asignaciones}} sinodalía(s)</p>
	    				<b>Telefono celular: </b><p>{{ $user->telefono }}</p>
	    			</div>
	    			<div class="col-md-6">
	    				
	    				<br><br><br>
	    				<a style="margin-right: 20px;" class="btn btn-light" href="">Editar</a>
	    				<a class="btn btn-light" href="">Eliminar</a>
	    			</div>
	    		</div>
	    	</div>
	    @endforeach
    </div>
@endsection
