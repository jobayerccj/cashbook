@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Edit Party info</h1>
@stop

@section('content')
	
	@include ('errors.parties_error_list');
	
	{!! Form::model($party, ['method' => 'PATCH', 'action' => ['PartyController@update', $party['party_id']]]) !!}
		    @include('parties.form_partials', ['submitButtonText' => 'Update Party info'])
	{!! Form::close() !!}
@stop