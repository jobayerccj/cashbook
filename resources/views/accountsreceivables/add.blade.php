@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Add new AccountsReceivables</h1>
@stop

@section('content')
	
	@include ('errors.accountsReceivables_error_list')
	
	{!! Form::open(array('url' => 'accountsReceivables')) !!}
	    @include('AccountsReceivables.form_partials', ['submitButtonText' => 'Add AccountsReceivables'])
	{!! Form::close() !!}


@stop