@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lorries
        <small>Add Lorry</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lorries</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

        <!-- Alert Message -->
        @if (Session::has('success'))
         <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success!</strong> {{ Session::get('success') }}
          </div>
        @elseif (Session::has('error'))
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> {{ Session::get('error') }}
          </div>
        @endif
        {{-- End Alert Message --}}

        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Lorry</h3>
              <a href="{{route('lorries')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('lorry.store')}}">
            @csrf
              <div class="box-body">
                {{-- Lorry Name --}}
                <div class="form-group {{ $errors->has('lorry_name') ? ' has-error' : '' }}">
                  <label for="Lorry_Name">Lorry Name
                  <span style="color: red;">*</span>
                  </label>
                  <input name="lorry_name" required type="text" class="form-control" id="lorry_name" placeholder="Enter Name / Number Of Lorry" value="{{old('lorry_name') }}">
                   	@if ($errors->has('lorry_name'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('lorry_name') }}</strong>
	                  </span>
                  	@endif
                </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Lorry</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection