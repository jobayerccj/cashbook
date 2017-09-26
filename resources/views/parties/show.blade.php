@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Party Detail</h1>
@stop

@section('content')
	
	<div class="table-responsive col-lg-5">
	  <table class="table">
	  	<tr>
	  		<td><b>Party Name</b></td>
	  		<td>{{ $party->party_name }}</td>
	  		
	  	</tr>
	  	<tr>
	  		<td><b>Email</b></td>
	  		<td>{{ $party->party_email }}</td>
	  		
	  	</tr>
	  	<tr>
	  		<td><b>Phone</b></td>
	  		<td>{{ $party->party_phone }}</td>
	  		
	  	</tr>
	  </table>
	</div>

	<div class="table-responsive col-lg-5">
	  <table class="table">
	  	<tr>
	  		<td><b>Address</b></td>
	  		
	  	</tr>
	  	<tr>
	  		
	  		<td>{{ $party->party_address }}</td>

	  	</tr>

	  	<tr>
	  		
	  		<td>&nbsp;</td>

	  	</tr>
	  </table>
	</div>
@stop