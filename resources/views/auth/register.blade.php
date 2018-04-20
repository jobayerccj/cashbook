@extends('layouts/master')

@section('content')
	<div class="col-md-8 blog-main">
		<h1>Register</h1>
		
		@include('partials/errors')
		
		<form method="POST" action="/register">

			{{ csrf_field() }}

		  <div class="form-group">
		    <label for="title">Name</label>
		    <input type="text" class="form-control" placeholder="Name" name="name">
		    
		  </div>
		  
		  <div class="form-group">
		    <label for="email">Email</label>
		    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
		    
		  </div>

		  <div class="form-group">
		    <label for="Password">Password</label>
		    <input type="password" class="form-control" id="Password" placeholder="Password" name="password">
		    
		  </div>

		  <div class="form-group">
		    <label for="password_confirm">Password Confirm</label>
		    <input type="password" class="form-control" id="password_confirm" placeholder="Password Confirmation" name="password_confirmation">
		    
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Register</button>
		</form>
	</div>
	
@endsection