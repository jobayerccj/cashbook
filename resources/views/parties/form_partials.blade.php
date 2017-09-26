<div class="form-group">
	{!! Form::label('name', 'Name:') !!}
	{!! Form::text('party_name', null, ['class' => 'form-control']) !!}
	
</div>

<div class="form-group">
	{!! Form::label('party_email', 'Email:') !!}
	{!! Form::text('party_email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('party_phone', 'Phone:') !!}
	{!! Form::text('party_phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('party_address', 'Address:') !!}
	{!! Form::textarea('party_address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>