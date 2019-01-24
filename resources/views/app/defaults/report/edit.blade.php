@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Defaults
        <small>Edit Sell Product Default</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Sell Product Default</li>
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
              <h3 class="box-title">Edit Sell Product Default</h3>
              <a href="{{route('default.product.sell')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('default.product.sell.update')}}">
            @csrf
              <div class="box-body">
                {{-- Product --}}
                <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                  <label for="product_id">Product
                  <span style="color: red;">*</span>
                  </label>
                  <select class="form-control select2" name="product_id" >
                    <option selected="" disabled="" value="{{$default_product_sell->product_id}}">{{$default_product_sell->product->product_name}}</option>

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
                  <select class="form-control select2" name="unit_id" >
                    <option selected="" disabled="" value="{{$default_product_sell->unit_id}}">{{$default_product_sell->unit->unit_name}}</option>
                  </select>
                    @if ($errors->has('unit_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('unit_id') }}</strong>
                    </span>
                    @endif
                </div>


              {{-- Sell Price Per Unit--}}
              <div class="form-group {{ $errors->has('sell_price') ? ' has-error' : '' }}">
                  <label for="sell_price">Price Per unit</label>
                  <span style="color: red;">*</span>
                  <input name="sell_price" required type="number" class="form-control" id="sell_price" placeholder="Enter Selling Price Per Unit" value="{{$default_product_sell->sell_price }}">
                    @if ($errors->has('sell_price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sell_price') }}</strong>
                    </span>
                    @endif
                </div>

              </div>

              <input type="hidden" name="default_product_sell_id" value="{{$default_product_sell->default_product_sell_id}}">

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Product Default Setting</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection