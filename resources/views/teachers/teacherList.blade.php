@extends('layouts.app')

@section('content')
    <div class="container">
    	@foreach($users as $user)
	    	<div class="jumbotron" style="">
	    		<h4>{{ $user->name }}</h4>
	    	</div>
	    @endforeach
    </div>
@endsection
