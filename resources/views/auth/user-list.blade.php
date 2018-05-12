@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Users
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
            <li class="active">User List</li>
          </ol>
        </section>

        <section class="content">
            <div class="btn-group margin-bottom-10">
                <a href="{{ url('/register') }}" class="btn green"><i class="icon-plus"></i> <?php echo 'User Add+' ?></a>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading clearfix">
                    <h2 class="panel-title">User List</h2>
                </div>

                <div class="panel-body">
                    
                    @if(Session::has('error_message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error_message') }}</p>
                    @endif

                    @if(Session::has('success_message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                    @endif

                    @if (count($user_list) > 0)
                    <table class="table table-striped table-bordered table-hover display responsive nowrap" id="sample_1" width="100%">
                        <thead>
                            <tr>
                                <th style="width:8px;">#</th>
                                <th><?php echo 'Name'; ?></th>
                                <th class="hidden-480"><?php echo 'Email'; ?></th>
                                
                                <th>@lang('auth.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($user_list as $user)
                           
                                    <tr class="odd gradeX">
                                        <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td class="hidden-480">
                                            {{ $user->email }}
                                        </td>
                                        
                                       
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ url('user/edit/'.$user->id) }}">Edit</a></li>
                                                    <li>

                                                    <a href="{{ url('user/'.$user->id.'/delete') }}" class="delete confirm">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @else
                        No records found!
                    @endif
                </div>
            </div>
        </section>
        
        <script type="text/javascript">
        //        $(document).ready(function(){
        //            $('#sample_1').dataTable({
        //                responsive: true,
        //            });
        //        })
        </script>
      </div>
@endsection