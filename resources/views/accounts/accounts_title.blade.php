@extends('layouts.master')
@section('page_title')
	<h1 class="page-header">Accounts Titles</h1>
@stop
    

@section('content')
    <div>
		<a href="{{ url('/accounts/create') }}" class="btn btn-primary">Add Account</a>
	</div>
	<br/>
    @if (count($accounts) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Accounts Lists
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Accounts ID</th>
                        <th>Account Title</th>
                        <th>Accounts Type</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                       @foreach($accounts as $account)
                       		<tr>
                       			<td>{{ $account->accounts_id }}</td>
                       			<td>{{ $account->accounts_title }}</td>
                       			<td>{{ $account->accounts_type }}</td>
                       			<td>{{ $account->created_at }}</td>
                       			<td>{{ $account->updated_at }}</td>
                       			<td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Select Action
                                         <span class='caret'></span></button>
                                            <ul class='dropdown-menu'>
                                                <li><a href=''>More Details</a></li>
                                                <li><a href="{{ url('accounts/'.$account->accounts_id.'/edit') }}">Edit</a></li>
                                                <li><a href="">Delete</a></li>
                                            </ul>
                                    </div>
                                </td>
                       		</tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
    	I don't have any records!
    @endif
@stop