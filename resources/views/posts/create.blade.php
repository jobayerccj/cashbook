@extends('layouts/master')

@section('content')
	<div class="col-md-8 blog-main">
		<h1>Publish a Post</h1>
		<hr/>

		@include('partials/errors')
		
		<form method="POST" action="/cashbook/posts">

			{{ csrf_field() }}

		  <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" placeholder="Title" name="title">
		    
		  </div>
		  <div class="form-group">
		    <label for="body">Body</label>
		    <textarea class="form-control" name="body"></textarea>
		    
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Publish</button>
		</form>
	</div>
	
@endsection