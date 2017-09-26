@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Edit Accounts Receivable info</h1>
@stop

@section('content')
	
	@include ('errors.accountsReceivables_error_list')
	
	{!! Form::model($accountsReceivable, ['method' => 'PATCH', 'action' => ['AccountsReceivablesController@update', $accountsReceivable['id']]]) !!}
		    @include('accountsReceivables.form_partials', ['submitButtonText' => 'Update accountsReceivable info'])
	{!! Form::close() !!}
@stop