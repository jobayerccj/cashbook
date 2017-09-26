@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Add new Party</h1>
@stop

@section('content')
	
	@include ('errors.parties_error_list')

	{!! Form::open(array('url' => 'parties')) !!}
	    @include('parties.form_partials', ['submitButtonText' => 'Add Party'])
	{!! Form::close() !!}


@stop