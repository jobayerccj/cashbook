@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Edit Accounts Payable info</h1>
@stop

@section('content')
	
	@include ('errors.accountsPayables_error_list')
	
	{!! Form::model($accountsPayable, ['method' => 'PATCH', 'action' => ['AccountsPayablesController@update', $accountsPayable['id']]]) !!}
		    @include('accountsPayables.form_partials', ['submitButtonText' => 'Update accountsPayable info'])
	{!! Form::close() !!}
@stop