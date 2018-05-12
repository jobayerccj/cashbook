@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
             <!-- Content Header (Page header) -->
              <section class="content-header">
                <h1>Language List</h1>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Language List</li>
                </ol>
              </section>
            </div>

            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title pull-right"><a href="{{ URL('/languages/create')}}">+ Add Language</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  @if(Session::has('success_message'))
                      <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                  @endif

                  @if (count($language_list) > 0)
                  <table class="table table-bordered table-hover DataTable">
                    <thead>
                    <tr>

                      <th>Name</th>
                      <th>Code</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($language_list as $key => $language)
                    <tr>
                      <td>{{ $language['name'] }}</td>
                      <td>{{ $language['code'] }}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                            <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                <li><a href="{{ URL('languages/'.$language['id'].'/edit') }}">Edit</a></li>
                                @if($language['code'] != 'en')
                                <li><a href="#" onclick="delete_language('{{ $language['id'] }}')">Delete</a></li>
                                @endif
                            </ul>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  @else
                  <p>No Record found</p>
                  @endif
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
        </div>
    </div>

    <script type="text/javascript">

       $(document).ready(function(){
           $('#language_list').dataTable({
               responsive: true,
           });
       });

       function delete_language(id){
            swal({
              title: "Are you sure?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false,
              html: false
            }, function(){
                $.ajax({
                  data:{id: id },
                  url: './languages/destroy',
                  type: "DELETE",
                  success: function(results){

                    swal({
                      title: "Language successfully deleted!",
                      type: "success",
                      text: ""
                    }, function(){
                      location.reload();
                    });

                  },
                  error: function(err){
                    console.log("error occur");
                    console.log(err);
                  }
                });
            });
          }
    </script>
  </div>
@endsection
