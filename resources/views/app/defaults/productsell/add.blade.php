@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Defaults
        <small>Add Sell Product Default</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Sell Product Default</li>
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
              <h3 class="box-title">Add Sell Product Default</h3>
              <a href="{{route('default.product.sell')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('default.product.sell.store')}}">
            @csrf
              <div class="box-body">
                {{-- Product --}}
                <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                  <label for="product_id">Product
                  <span style="color: red;">*</span>
                  </label>
                  <select class="form-control select2" name="product_id" required="" >
                    <option selected="" disabled="">Select Product</option>
                    @foreach($products as $product)
                    <option value="{{$product->product_id}}"> {{$product->product_name}} </option>
                    @endforeach
                  </select>
                   	@if ($errors->has('product_id'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('product_id') }}</strong>
	                  </span>
                  	@endif
                </div>

                {{-- Unit --}}
                <div class="form-group {{ $errors->has('unit_id') ? ' has-error' : '' }}">
                  <label for="unit_id">Unit
                  <span style="color: red;">*</span>
                  </label>
                  <select class="form-control select2" name="unit_id" required="" >
                    <option selected="" disabled="">Select Unit</option>
                    @foreach($units as $unit)
                    <option value="{{$unit->unit_id}}"> {{$unit->unit_name}} </option>
                    @endforeach
                  </select>
                    @if ($errors->has('unit_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('unit_id') }}</strong>
                    </span>
                    @endif
                </div>

              {{-- Purchase Price Per Unit--}}
              <div class="form-group {{ $errors->has('purchase_price') ? ' has-error' : '' }}">
                  <label for="purchase_price">Purchase Price Per unit</label>
                  <span style="color: red;">*</span>
                  <input name="purchase_price" required type="number" class="form-control" id="purchase_price" placeholder="Enter Purchase Price Per Unit" value="{{old('purchase_price') }}">
                    @if ($errors->has('purchase_price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchase_price') }}</strong>
                    </span>
                    @endif
                </div>

              {{-- Sell Price Per Unit--}}
              <div class="form-group {{ $errors->has('sell_price') ? ' has-error' : '' }}">
                  <label for="sell_price">Sell Price Per unit</label>
                  <span style="color: red;">*</span>
                  <input name="sell_price" required type="number" class="form-control" id="sell_price" placeholder="Enter Selling Price Per Unit" value="{{old('sell_price') }}">
                    @if ($errors->has('sell_price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sell_price') }}</strong>
                    </span>
                    @endif
                </div>

              </div>


              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Product Default Setting</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection