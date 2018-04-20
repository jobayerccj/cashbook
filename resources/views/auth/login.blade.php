@extends('layouts/master')

@section('content')
	<div class="col-md-8 blog-main">
		<h1>Login</h1>
		<hr/>

		@include('partials/errors')
		
		<form method="POST" action="/login">

			{{ csrf_field() }}

		  <div class="form-group">
		    <label for="email">Email</label>
		    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
		    
		  </div>
		  
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" id="password" placeholder="password" name="password">
		    
		  </div>
		  
		  
		  <button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
	
@endsection