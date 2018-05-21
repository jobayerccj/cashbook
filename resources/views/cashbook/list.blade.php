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
                  
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addCashbookModal">+ Add Cashflow</button>

                    <button class="btn btn-info" data-toggle="modal" data-target="#showPdfModal1"> <i class="fa fa-file-pdf-o"> </i> &nbsp; Generate PDF Report</button>

                    <a href="{{ url('cashflow/generate_excel') }}" class="btn btn-warning">Generate Excel</a>
                    <!--<button class="btn btn-warning" data-toggle="modal" data-target="#showExcelModal1"> <i class="fa fa-file-excel-o"> </i> &nbsp; Generate Excel Report</button>-->
                  
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
                                      <li><a href="#" onclick="showEditModal({{ $cashflow['id'] }})">Edit</a></li>
                                     
                                      <li><a href="#" onclick="showDetailModal({{ $cashflow['id'] }})">Detail</a></li>
                                      
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
              <div id="validation_errors1"></div>
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
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal for cashbook edit -->
    <div class="modal fade" id="editCashbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Update Cashbook</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" id="cashbook_edit_form1">
          <div class="modal-body" id="edit_body">
              
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal for cashbook detail -->
    <div class="modal fade" id="detailCashbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Cashbook Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body" id="detail_body">
              
          </div>
        </div>
      </div>
    </div>

    <!-- Modal1 for cashbook pdf -->
    <div class="modal fade" id="showPdfModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Pdf Repoprt</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body" >
            <div id="validation_errors1"></div>
            <form method="POST" id="cashbook_pdf_form1">
              <div class="form-group">
                <div class="col-sm-3"><label>From</label>
                  <input type="text" class="form-control datepicker" placeholder="From" name="start_from">
                </div>
                <div class="col-sm-3"><label>To</label>
                  <input type="text" class="form-control datepicker" placeholder="To" name="start_to">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-6">
                  <br/>
                  
                  <button type="submit" class="btn btn-info">Generate</button>
                </div>
              </div>

                <div class="modal-footer" style="border-top: none">
                  
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal1 for cashbook excel report -->
    <div class="modal fade" id="showExcelModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Excel Report</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body" id="detail_body">
              
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(".datepicker").datepicker();

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

            
          }
        });
      });

      $(document).on('submit', "#cashbook_edit_form1", function(e){
        
        e.preventDefault();
        var id = $('input[name="id"]').val();

        $.ajax({
          type: "PUT",
          data: $(this).serialize(),
          url: "./cashflow/" + id ,
          success: function(response){
            var result = JSON.parse(response);
            if(result['success']){
              $("#editCashbookModal").modal('hide');
              $("#success_message1").html('<div class="alert alert-success" role="alert">'+result['message'] +'</div>');
            }
            else{
              var error_list = "";
              $.each(result['message'], function(index, value){
                error_list += '<li class="list-group-item list-group-item-danger">' + value +'</li>';
              });

              $("div#validation_errors1").html('<ul class="list-group">' + error_list +"</ul>");
            }

            
          }
        });
      });


      $(document).on('submit', "#cashbook_pdf_form1", function(e){
        
        e.preventDefault();
        
        $.ajax({
          type: "GET",
          data: $(this).serialize(),
          url: "./cashflow/generate_pdf",
          success: function(response){
            
            var result = JSON.parse(response);
            if(result['success']){
              var x = window.open("./uploads/pdf/" + result['filename']);

              if (!x){
                alert('your window is blocked!');
              }
              
              $("#showPdfModal1").modal('hide');
              $("#success_message1").html('<div class="alert alert-success" role="alert">'+result['message'] +'</div>');
            }
            else{
              var error_list = "";
              $.each(result['message'], function(index, value){
                error_list += '<li class="list-group-item list-group-item-danger">' + value +'</li>';
              });

              $("div#validation_errors1").html('<ul class="list-group">' + error_list +"</ul>");
            }
            
          }
        });
      });

      function showDetailModal(cashbook_id){
        $.ajax({
          type: "GET",
          data: {_token: "{{ csrf_token() }}" },
          url: "./cashflow/" + cashbook_id,
          success: function(response){
            $("#detail_body").html(response);
            $("#detailCashbookModal").modal('show');
            
          }
        });
      } 

      function showEditModal(cashbook_id){
        $.ajax({
          type: "GET",
          data: {_token: "{{ csrf_token() }}" },
          url: "./cashflow/" + cashbook_id + "/edit",
          success: function(response){
            $("#edit_body").html(response);
            $("#editCashbookModal").modal('show');
          }
        });
      } 
    </script>
  </div>

@endsection
