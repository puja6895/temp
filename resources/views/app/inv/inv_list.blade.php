@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory
        <small>All Stock</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
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
              <h3 class="box-title">Inventory</h3>
              <a href="{{route('inventory.add')}}" class="pull-right">
              	<button class="btn btn-info"><b>Add New+</b></button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Product Name</th>
                  <th>Stock</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inventories as $index => $inv)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$inv->product->product_name}}</td>
                  <td>{{$inv->stock}} - {{$inv->unit->unit_name}}</td>
                  <td>
                  	@if($inv->stock > 10)
                  		<label class="label label-success">In Stock</label>
                  	@elseif($inv->stock < 10 && $inv->stock > 0)
                  		<label class="label label-warning">Low Stock</label>
                    @elseif($inv->stock < 1)
                      <label class="label label-danger">Out Of Stock</label>
                  	@endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <th>Sr.No</th>
                  <th>Product Name</th>
                  <th>Stock</th>
                  <th>Status</th>
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