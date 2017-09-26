@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Add new AccountsPayables</h1>
@stop

@section('content')
	
	@include ('errors.accountsPayables_error_list')
	
	{!! Form::open(array('url' => 'accountsPayables')) !!}
	    @include('AccountsPayables.form_partials', ['submitButtonText' => 'Add AccountsPayables'])
	{!! Form::close() !!}


@stop