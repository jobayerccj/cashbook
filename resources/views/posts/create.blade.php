@extends('layouts/master')

@section('content')
	<div class="col-md-8 blog-main">
		<h1>Publish a Post</h1>
		<hr/>

		<form method="POST" action="/posts">

			{{ csrf_field() }}

		  <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title">
		    
		  </div>
		  <div class="form-group">
		    <label for="body">Body</label>
		    <textarea class="form-control"></textarea>
		    
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Publish</button>
		</form>
	</div>
	
@endsection