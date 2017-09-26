@extends('layouts.master')
@section('page_title')
	<h1 class="page-header">Edit Accounts Titles</h1>
@stop
    

@section('content')
    <div class="row">
    	<div class="col-md-3"></div>
    	<div class="col-md-6">
    		{!! Form::model($accounts_edit,['method'=>'PATCH','action'=>['AccountsController@update',$accounts_edit['accounts_id']]]) !!}
    			<div class="form-group">
    				{!! Form::label('accounts_title','Accounts Title') !!}
    				{!! Form::text('accounts_title',null,['class'=>'form-control']) !!}
    				<span class="alert-danger">{{ $errors->first('accounts_title') }}</span>
    			</div>
    			
    			<div class="form-group">
    				{!! Form::label('accounts_type','Accounts Type') !!}
    				{!! Form::select('accounts_type',$accounts_type,null,['class'=>'form-control']) !!}
    				<span class="alert-danger">{{ $errors->first('accounts_type') }}</span>
    			</div>
    			
    			<div class="form-group">
    				{!! Form::submit('Save',['class'=>'btn btn-success']) !!}
    			</div>
    		{!! Form::close() !!}
    	</div>
    	<div class="col-md-3"></div>
    </div>
@stop