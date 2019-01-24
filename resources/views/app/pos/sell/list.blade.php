@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales
        <small>All Sales</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
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
              <h3 class="box-title">Sales</h3>
              <a href="{{route('sell.add')}}" class="pull-right">
              	<button class="btn btn-info"><b>Add New+</b></button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Sell Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sells as $sell)
                <tr>
                  <td>{{$sell->customer->customer_name}}</td>
                  <td>{{\Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y')}}</td>
                  <td>  <b><i class="fa fa-inr"></i> {{$sell->sell_amount->grand_total}} </b></td>
                  <td>
                    {{$sell->sell_status == 1 ? 'Unbilled' : 'Billed'}}
                  </td>
                  <td>
                    <a href="{{route('sell.show',['id'=>$sell->sell_id])}}">
                      <button class="btn btn-sm btn-success">View</button>
                    </a>
                  	<!-- <a href="{{route('product.edit',['id'=>$sell->sell_id])}}">
                  		<button class="btn btn-sm btn-info">Edit</button>
                  	</a> -->
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Customer Name</th>
                  <th>Sell Date</th>
                  <th>Amount</th>
                  <th>Status</th>
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