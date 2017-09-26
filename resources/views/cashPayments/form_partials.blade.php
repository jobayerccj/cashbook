
<div class="form-group">
	{!! Form::label('party_id', 'Party:') !!}
	{!! Form::select('party_id',$parties, null, ['class'=>'form-control']) !!}
	
</div>

<div class="form-group">
	{!! Form::label('accounts_credited', 'Accounts Credited:') !!}
	{!! Form::select('accounts_credited',$accounts_credited, null, ['class'=>'form-control']) !!}
	
</div>

<div class="form-group">
	{!! Form::label('expected_payments_date', 'Expected Date:') !!}
	{!! Form::date('expected_payments_date', $date_default, ['class' => 'form-control' , 'id' => 'payable_datepicker']) !!}
</div>

<div class="form-group">
	{!! Form::label('total_amount', 'Total Amount:') !!}
	{!! Form::text('total_amount', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>



<script>
$(function() {
$( "#payable_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

