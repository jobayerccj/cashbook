@extends('layouts.master')
@section('page_title')
    <h1 class="page-header">Parties List</h1>
@stop
@section('content')

    <div>
        <a href="{{ url('/parties/create') }}" class="btn btn-primary">Add Party</a>
    </div>
    <br/>
    @if (count($parties) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Parties
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table table-responsive">

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($parties as $party)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $party->party_name }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $party->party_email }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $party->party_phone }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $party->party_address }}</div>
                                </td>

                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Select Action
                                         <span class='caret'></span></button>
                                            <ul class='dropdown-menu'>
                                                <li><a href='{{ url('/parties/'.$party->party_id) }}'>More Details</a></li>
                                                <li><a href="{{ url('/parties/'.$party->party_id.'/edit') }}">Edit</a></li>
                                                <li>
                                                    {!! Form::open(['method' => 'DELETE', 'id' => 'partyDelete', 'action' => ['PartyController@destroy', $party['party_id']]]) !!}
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

                {{ $parties->links() }}
            </div>
        </div>
        @else
        I don't have any records!
    @endif

<script>
    
     $(document).off('submit', "#partyDelete").on('submit', "#partyDelete", function (event) {
        
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

