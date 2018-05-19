@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
             <!-- Content Header (Page header) -->
              <section class="content-header">
                <h1>Cashflow List</h1>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Cashflow List</li>
                </ol>
              </section>
            </div>

            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title pull-right"><a href="#" data-toggle="modal" data-target="#addCashbookModal">+ Add Cashflow</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="success_message1"></div>
                 
                  @if (count($cashflow_list) > 0)
                  <table class="table table-bordered table-hover DataTable" id="cashflow_list">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Cash Inflow($)</th>
                      <th>Cash Outflow($)</th>
                      <th>Balance($)</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cashflow_list as $key => $cashflow)
                          <tr>
                            <td>{{ $cashflow['id'] }}</td>
                            <td>{{ $cashflow['name'] }}</td>
                            <td>{{ $cashflow['flow_type'] == 1 ? $cashflow['amount'] : '' }}</td>
                            <td>{{ $cashflow['flow_type'] == 2 ? $cashflow['amount'] : '' }}</td>
                            <td>
                              
                              {{ $cashflow['balance'] }}
                            </td>
                            <td>
                              <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  Action
                                  <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                      <li><a href="{{ URL('cashflow/'.$cashflow['id'].'/edit') }}">Edit</a></li>
                                     
                                      <li><a href="#" >Detail</a></li>
                                      
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

    <!-- Modal for cashbook entry -->
    <div class="modal fade" id="addCashbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Insert Cashbook</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" id="cashbook_entry_form1">
          <div class="modal-body">
              <div id="validation_errors1">
                
              </div>
              {{ csrf_field() }}
              <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="My first payment" name="name">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput2">Amount</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="1234" name="amount">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Flow Type</label>
                <select class="form-control" id="exampleFormControlSelect1" name="flow_type">
                  <option value="">...</option>
                  <option value="1">Cash Inflow</option>
                  <option value="2">Cash Outflow</option>
                  
                </select>
              </div>
              
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
              </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">

       $(document).ready(function(){
           $('#cashflow_list').dataTable({
               responsive: true,
               "aaSorting": [],
           });
       });

       
          $(document).on('submit', "#cashbook_entry_form1", function(e){
            
            e.preventDefault();
            
            $.ajax({
              type: "POST",
              data: $(this).serialize(),
              url: "./cashflow",
              success: function(response){
                var result = JSON.parse(response);
                if(result['success']){
                  $("#addCashbookModal").modal('hide');
                  $("#success_message1").html('<div class="alert alert-success" role="alert">'+result['message'] +'</div>');
                }
                else{
                  var error_list = "";
                  $.each(result['message'], function(index, value){
                    error_list += '<li class="list-group-item list-group-item-danger">' + value +'</li>';
                  });

                  $("#validation_errors1").html('<ul class="list-group">' + error_list +"</ul>");
                }

                console.log(result);
              }
            });
          });
    </script>
  </div>

@endsection
