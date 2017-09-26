@extends('layouts.master')
@section('page_title')
    <h1 class="page-header">Accounts Payables List</h1>
@stop
@section('content')
 
    <div>
        <a href="{{ url('/accountsPayables/create') }}" class="btn btn-primary">Add Accounts Payable</a>
    </div>
    <br/>
    @if (count($accountsPayables) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Accounts Receivables
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table table-responsive">

                    <!-- Table Headings -->
                    <thead>
                        <th>Party Name</th>
                        <th>Account Debited</th>
                        <th>Expected Date</th>
                        <th>Total Amount</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($accountsPayables as $accountsPayable)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $accountsPayable->party_name }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsPayable->accounts_credited }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsPayable->expected_payments_date }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsPayable->total_amount }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsPayable->description }}</div>
                                </td>

                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Select Action
                                         <span class='caret'></span></button>
                                            <ul class='dropdown-menu'>
                                                <li><a href='{{ url('/accountsPayables/'.$accountsPayable->id) }}'>More Details</a></li>
                                                <li><a href="{{ url('/accountsPayables/'.$accountsPayable->id.'/edit') }}">Edit</a></li>
                                                <li>
                                                    {!! Form::open(['method' => 'DELETE', 'id' => 'accountsPayablesDelete', 'action' => ['AccountsPayablesController@destroy', $accountsPayable->id]]) !!}
                                                            <input type="submit" value="DELETE" class="delete_btn_zero">
                                                    {!! Form::close() !!}
                                                   
                                                </li>
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $accountsPayables->links() }}
            </div>
        </div>
        @else
        I don't have any records!
    @endif

   <script>
    
     $(document).off('submit', "#accountsPayablesDelete").on('submit', "#accountsPayablesDelete", function (event) {
        
        var x = confirm("Are you sure you want to delete?");
            if (x) {
                return true;
            }
            else {
                event.preventDefault();
                return false;
            }

    });
</script>
@stop

