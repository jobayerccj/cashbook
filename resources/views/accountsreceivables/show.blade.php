@extends('layouts.master')

@section('page_title')
	<h1 class="page-header">Accounts Receivable Detail</h1>
@stop

@section('content')
	
	<div class="table-responsive col-lg-5">
	  <table class="table">
	  	<tr>
	  		<td><b>Party Name</b></td>
	  		<td>{{ $accountsReceivable[0]->party_name }}</td>
	  		
	  	</tr>
	  	<tr>
	  		<td><b>Accounts Debited</b></td>
	  		<td>{{ $accountsReceivable[0]->accounts_debited }}</td>
	  		
	  	</tr>
	  	<tr>
	  		<td><b>Expected Receiving Date</b></td>
	  		<td>{{ $accountsReceivable[0]->expected_receieving_date }}</td>
	  		
	  	</tr>
	  	<tr>
	  		<td><b>Total Amount</b></td>
	  		<td>{{ $accountsReceivable[0]->total_amount }}</td>
	  		
	  	</tr>
	  </table>
	</div>

	<div class="table-responsive col-lg-5">
	  <table class="table">
	  	<tr>
	  		<td><b>Address</b></td>
	  		
	  	</tr>
	  	<tr>
	  		
	  		<td>{{ $accountsReceivable[0]->description }}</td>

	  	</tr>

	  	<tr>
	  		
	  		<td>&nbsp;</td>

	  	</tr>
	  </table>
	</div>
@stop