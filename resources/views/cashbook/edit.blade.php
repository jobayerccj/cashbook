<div id="validation_errors1">
                
</div>
{{ csrf_field() }}

<div class="form-group">
  <label for="exampleFormControlInput1">Name</label>
  <input type="hidden" name="id" value="{{ $detail['id'] }}">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="My first payment" name="name" value="{{ $detail['name'] }}">
</div>
<div class="form-group">
  <label for="exampleFormControlInput2">Amount</label>
  <span data-toggle="tooltip" data-placement="top" title="You can't change amount now, if you need to change balance, then insert another cashflow entry to do it.">[?]
  </span>
  <input type="text" class="form-control" id="exampleFormControlInput2" value="{{ $detail['amount'] }}" readonly="">
</div>
<div class="form-group">
  <label for="exampleFormControlSelect1">Flow Type</label>
  <select class="form-control" id="exampleFormControlSelect1" name="flow_type">
    <option value="">...</option>
    <option value="1" @if($detail['flow_type'] == 1) selected="" @endif>Cash Inflow</option>
    <option value="2" @if($detail['flow_type'] == 2) selected="" @endif>Cash Outflow</option>
    
  </select>
</div>

<div class="form-group">
  <label for="exampleFormControlTextarea1">Description</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $detail['description'] }}</textarea>
</div>