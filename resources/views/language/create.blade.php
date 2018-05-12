@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
      <div class="content-wrapper">

         <div class="row">
          <div class="col-md-12">
             <!-- Content Header (Page header) -->
              <section class="content-header">
                <h1>Language Add</h1>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Language Add</li>
                </ol>
              </section>
          </div>

          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body pad">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ URL('/languages') }}">
                  {{ csrf_field() }}
                  <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="Language Name" name="name" value="{{ old('name') }}">

                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="Language Code" name="code" value="{{ old('code') }}">

                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
    </div>

@endsection
