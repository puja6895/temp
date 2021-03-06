@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Mode Master
        <small>Add Payment Mode</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment Mode Master</li>
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
              <h3 class="box-title">Add Payment Mode</h3>
              <a href="{{route('master.payment-mode')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('master.payment-mode.store')}}">
            @csrf
              <div class="box-body">
                {{-- Payment Mode  --}}
                <div class="form-group {{ $errors->has('payment_mode') ? ' has-error' : '' }}">
                  <label for="payment_mode">Paymnet Mode</label>
                  <input name="payment_mode" required type="text" class="form-control" id="name" placeholder="Enter Payment Mode" value="{{old('payment_mode') }}">
                   	@if ($errors->has('payment_mode'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('payment_mode') }}</strong>
	                  </span>
                  	@endif
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Payment Mode</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection