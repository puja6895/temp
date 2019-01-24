@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Defaults
        <small>Product Sell</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Defaults</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Default Product Sell</h3>
              <a href="{{route('default.product.sell.add')}}" class="pull-right">
              	<button class="btn btn-info"><b>Add New+</b></button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.NO</th>
                  <th>Product Name</th>
                  <th>Prchase Price</th>
                  <th>Sell Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product_sell_defaults as $index => $product_sell_default)
                <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$product_sell_default->product->product_name}}</td>
                  <td> <i class="fa fa-inr fa-lg"></i>  {{$product_sell_default->purchase_price}} / {{$product_sell_default->unit->unit_name}}</td>
                  <td> <i class="fa fa-inr fa-lg"></i>  {{$product_sell_default->sell_price}} / {{$product_sell_default->unit->unit_name}}</td>
                  <td>
                  	<a href="{{route('default.product.sell.edit',['id'=>$product_sell_default->default_product_sell_id])}}">
                  		<button class="btn btn-sm btn-info">Edit</button>
                  	</a>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Sr.NO</th>
                  <th>Product Name</th>
                  <th>Sell Price</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection