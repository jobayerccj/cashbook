<table class="table table-responsive table-bordered">
  
  <tbody>
    <tr>
      <td>Name</td>
      <td>{{ $detail['name'] }}</td>
    </tr>
    <tr>
      <td>Amount</td>
      <td>{{ $detail['amount'] }}</td>
    </tr>
    <tr>
      <td>Description</td>
      <td>{{ $detail['description'] }}</td>
    </tr>
    <tr>
      <td>Flow Type</td>
      <td>{{ $detail['flow_type'] == 1 ? "Inflow": "Outflow"}}</td>
    </tr>
    <tr>
      <td>Balance</td>
      <td>{{ $detail['balance'] }}</td>
    </tr>
    
  </tbody>
</table>