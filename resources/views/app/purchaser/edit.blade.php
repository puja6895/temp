@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchasers
        <small>Edit Purchasers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchaser</li>
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
              <h3 class="box-title">Edit Purchaser</h3>
              <a href="{{route('purchasers')}}" class="pull-right">
                <button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('purchaser.update')}}">
            @csrf
              <div class="box-body">
                {{-- Purchaser Name --}}
                <div class="form-group {{ $errors->has('purchaser_name') ? ' has-error' : '' }}">
                  <label for="Purchaser_Name">Purchaser Name
                  <span style="color: red;">*</span>
                  </label>
                  <input name="purchaser_name" required type="text" class="form-control" id="purchaser_name" placeholder="Enter Name Of Purchaser" value="{{$purchaser->purchaser_name }}">
                    @if ($errors->has('purchaser_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchaser_name') }}</strong>
                    </span>
                    @endif
                </div>

                {{-- Purchaser Email --}}
                <div class="form-group {{ $errors->has('purchaser_email') ? ' has-error' : '' }}">
                  <label for="purchaser_email">Purchaser Email</label>
                  <input name="purchaser_email" type="text" class="form-control" id="purchaser_email" placeholder="Enter Email Of Purchaser" value="{{$purchaser->purchaser_email }}">
                    @if ($errors->has('purchaser_email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchaser_email') }}</strong>
                    </span>
                    @endif
                </div>


              {{-- Purchaser Mobile --}}
              <div class="form-group {{ $errors->has('purchaser_mobile') ? ' has-error' : '' }}">
                  <label for="purchaser_mobile">Purchaser Mobile</label>
                  <span style="color: red;">*</span>
                  <input name="purchaser_mobile" required type="text" class="form-control" id="purchaser_mobile" placeholder="Enter Mobile Of Purchaser" value="{{$purchaser->purchaser_mobile }}">
                    @if ($errors->has('purchaser_mobile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchaser_mobile') }}</strong>
                    </span>
                    @endif
                </div>

              {{-- Purchaser Address --}}
              <div class="form-group {{ $errors->has('purchaser_address') ? ' has-error' : '' }}">
                  <label for="purchaser_address">Purchaser Address</label>
                  <input name="purchaser_address" type="text" class="form-control" id="purchaser_address" placeholder="Enter Address Of Purchaser" value="{{$purchaser->purchaser_address }}">
                    @if ($errors->has('purchaser_address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchaser_address') }}</strong>
                    </span>
                    @endif
                </div>

              {{-- Purchaser Company Name --}}
              <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                  <label for="company">Purchaser Company</label>
                  <input name="company" type="text" class="form-control" id="company" placeholder="Enter Company Of Purchaser" value="{{$purchaser->company }}">
                    @if ($errors->has('company'))
                    <span class="help-block">
                        <strong>{{ $errors->first('company') }}</strong>
                    </span>
                    @endif
                </div>


              </div>

              <input type="hidden" name="purchaser_id" value="{{$purchaser->purchaser_id}}">
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Purchaser</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection