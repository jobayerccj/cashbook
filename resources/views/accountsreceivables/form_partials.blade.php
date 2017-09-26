
<div class="form-group">
	{!! Form::label('party_id', 'Party:') !!}
	{!! Form::select('party_id',$parties, null, ['class'=>'form-control']) !!}
	
</div>

<div class="form-group">
	{!! Form::label('accounts_debited', 'Accounts Debited:') !!}
	{!! Form::select('accounts_debited',$account_debited, null, ['class'=>'form-control']) !!}
	
</div>

<div class="form-group">
	{!! Form::label('expected_receieving_date', 'Expected Date:') !!}
	{!! Form::date('expected_receieving_date', $date_default, ['class' => 'form-control' , 'id' => 'datepicker']) !!}
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
$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

