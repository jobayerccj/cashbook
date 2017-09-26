@extends('layouts.master')
@section('page_title')
    <h1 class="page-header">Accounts Receivables List</h1>
@stop
@section('content')
 
    <div>
        <a href="{{ url('/accountsReceivables/create') }}" class="btn btn-primary">Add Accounts Receivable</a>
    </div>
    <br/>
    @if (count($accountsReceivables) > 0)
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
                        @foreach ($accountsReceivables as $accountsReceivable)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $accountsReceivable->party_name }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsReceivable->accounts_debited }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsReceivable->expected_receieving_date }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsReceivable->total_amount }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $accountsReceivable->description }}</div>
                                </td>

                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Select Action
                                         <span class='caret'></span></button>
                                            <ul class='dropdown-menu'>
                                                <li><a href='{{ url('/accountsReceivables/'.$accountsReceivable->id) }}'>More Details</a></li>
                                                <li><a href="{{ url('/accountsReceivables/'.$accountsReceivable->id.'/edit') }}">Edit</a></li>
                                                <li>
                                                    {!! Form::open(['method' => 'DELETE', 'id' => 'accountsReceivableDelete', 'action' => ['AccountsReceivablesController@destroy', $accountsReceivable->id]]) !!}
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

                {{ $accountsReceivables->links() }}
            </div>
        </div>
        @else
        I don't have any records!
    @endif

   <script>
    
     $(document).off('submit', "#accountsReceivableDelete").on('submit', "#accountsReceivableDelete", function (event) {
        
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

