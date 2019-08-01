@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customers
        <small>Edit Customer</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer</li>
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
              <h3 class="box-title">Edit Customer</h3>
              <a href="{{route('customers')}}" class="pull-right">
                <button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('customer.update')}}">
            @csrf
              <div class="box-body">
                {{-- Customer Name --}}
                <div class="form-group {{ $errors->has('customer_name') ? ' has-error' : '' }}">
                  <label for="Customer_Name">Customer Name
                  <span style="color: red;">*</span>
                  </label>
                  <input name="customer_name" required type="text" class="form-control" id="customer_name" placeholder="Enter Name Of Customer" value="{{$customer->customer_name }}">
                    @if ($errors->has('customer_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('customer_name') }}</strong>
                    </span>
                    @endif
                </div>

                {{-- Customer Email --}}
                <div class="form-group {{ $errors->has('customer_email') ? ' has-error' : '' }}">
                  <label for="customer_email">Customer Email</label>
                  <input name="customer_email" type="text" class="form-control" id="customer_email" placeholder="Enter Email Of Customer" value="{{$customer->customer_email }}">
                    @if ($errors->has('customer_email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('customer_email') }}</strong>
                    </span>
                    @endif
                </div>


              {{-- Customer Mobile --}}
              <div class="form-group {{ $errors->has('customer_mobile') ? ' has-error' : '' }}">
                  <label for="customer_mobile">Customer Mobile</label>
                  <span style="color: red;">*</span>
                  <input name="customer_mobile" required type="text" class="form-control" id="customer_mobile" placeholder="Enter Mobile Of Customer" value="{{$customer->customer_mobile }}">
                    @if ($errors->has('customer_mobile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('customer_mobile') }}</strong>
                    </span>
                    @endif
                </div>

              {{-- Customer Address --}}
              <div class="form-group {{ $errors->has('customer_address') ? ' has-error' : '' }}">
                  <label for="customer_address">Customer Address</label>
                  <input name="customer_address" type="text" class="form-control" id="customer_address" placeholder="Enter Address Of Customer" value="{{$customer->customer_address }}">
                    @if ($errors->has('customer_address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('customer_address') }}</strong>
                    </span>
                    @endif
                </div>


              </div>

              <input type="hidden" name="customer_id" value="{{$customer->customer_id}}">
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Customer</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection