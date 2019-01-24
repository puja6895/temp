@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory
        <small>Add Inventory</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
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
              <h3 class="box-title">Add Inventory</h3>
              <a href="{{route('inventory')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('inventory.store')}}">
            @csrf
              <div class="box-body">
                {{-- Product Name --}}
                <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                  <label for="product_id">Product Name
                  <span style="color: red;">*</span>
                  </label>
                  <select class="form-control select2" name="product_id" required>
                    <option disabled="" selected="">Select Product</option>
                    @foreach($products as $product)
                      <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                    @endforeach
                  </select>
                   	@if ($errors->has('product_id'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('product_id') }}</strong>
	                  </span>
                  	@endif
                </div>

                <!-- Unit -->
                <div class="form-group {{ $errors->has('unit_id') ? ' has-error' : '' }}">
                  <label for="unit_id">Unit Name
                  <span style="color: red;">*</span>
                  </label>
                  <select class="form-control select2" name="unit_id" required>
                    <option disabled="" selected="">Select Unit</option>
                    @foreach($units as $unit)
                      <option value="{{$unit->unit_id}}">{{$unit->unit_name}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('unit_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('unit_id') }}</strong>
                    </span>
                    @endif
                </div>

                <!-- Quantity -->
                <div class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
                  <label for="quantity">Quantity
                  <span style="color: red;">*</span>
                  </label>
                  <input type="number" name="quantity" required class="form-control">
                    @if ($errors->has('quantity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                    @endif
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Product To Inventory</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection