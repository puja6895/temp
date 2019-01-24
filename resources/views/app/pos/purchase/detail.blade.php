@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase
        <small>Purchase Detail</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Detail</li>
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
              <h3 class="box-title">Purchase Detail</h3>
              <a href="{{route('purchase')}}" class="pull-right">
              	<button class="btn btn-info"><b>Back</b></button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <h3>Purchaser</h3>
              <table class="table table-bordered table-striped">
                <tr>
                  <td align="right">Purchaser Name:</td>
                  <td>{{$purchase->purchaser->purchaser_name}}</td>
                  <td align="right">Mobile Number:</td>
                  <td>{{$purchase->purchaser->purchaser_mobile}}</td>
                </tr>
                <tr>
                  <td align="right">Company:</td>
                  <td>{{$purchase->purchaser->company}}</td>
                  <td align="right">Address:</td>
                  <td>{{$purchase->purchaser->purchaser_address}}</td>
                </tr>
              </table>

              <h3>Products</h3>
              <table class="table table-bordered table-striped">
                <tr>
                  <th>Product</th>
                  <th>Rate</th>
                  <th>Quantity</th>
                  <th>Gst</th>
                  <th>Amount</th>
                </tr>
                @foreach($purchase->purchase_product as $p_product)
                <tr>
                  <td>{{$p_product->product->product_name}}</td>
                  <td> <i class="fa fa-inr"></i> {{$p_product->rate}} / {{$p_product->unit->unit_name}}</td>
                  <td>{{$p_product->quantity}}</td>
                  <td> <i class="fa fa-inr"></i> {{$p_product->gst_amount}} ({{$p_product->gst}} %)</td>
                  <td> <i class="fa fa-inr"></i> {{$p_product->amount}}</td>
                </tr>
               @endforeach

               <tr>
                 <td align="right" colspan="3">Total:</td>
                 <td><i class="fa fa-inr"></i> {{$purchase->purchase_amount->gst}}</td>
                 <td><i class="fa fa-inr"></i> {{$purchase->purchase_amount->subtotal}}</td>
               </tr>
               <tr>
                 <td align="right" colspan="4">Grand Total:</td>
                 <td><i class="fa fa-inr"></i> {{$purchase->purchase_amount->grand_total}}</td>
               </tr>
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