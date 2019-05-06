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
					@include('app.common.alert')
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

						<h3>Products/Materials</h3>
						<table class="table table-bordered table-striped">
							<tr>
								<th>Product</th>
								<th>Rate</th>
								<th>Quantity</th>
								<th class="text-right">Gst</th>
								<th class="text-right">Amount</th>
							</tr>
							@foreach($purchase->purchase_product as $p_product)
							<tr>
								<td>{{$p_product->product->product_name}}</td>
								<td> <i class="fa fa-inr"></i> {{$p_product->rate}} / {{$p_product->unit->unit_name}}</td>
								<td>{{$p_product->quantity}}</td>
								<td class="text-right"> <i class="fa fa-inr"></i> {{$p_product->gst_amount}} ({{$p_product->gst}} %)</td>
								<td class="text-right"> <i class="fa fa-inr"></i> {{$p_product->amount}}</td>
							</tr>
							@endforeach

							<tr>
								<td align="right" colspan="3">Total:</td>
								<td class="text-right"> <b><i class="fa fa-inr"></i> {{$purchase->purchase_amount->gst}}</b></td>
								<td class="text-right"> <b><i class="fa fa-inr"></i> {{$purchase->purchase_amount->subtotal}}</b></td>
							</tr>
							<tr>
								<td align="right" colspan="4">Grand Total:</td>
								<td class="text-right"><b><i class="fa fa-inr"></i> {{$purchase->purchase_amount->grand_total}}</b></td>
							</tr>
						</table>

						<!-- Payments -->
						<div class="row">
							<div class="col-md-6">
								<h3>Payments</h3>
							</div>
							<div class="col-md-6">
								<a href="{{route('payables.payment',['purchase_id'=>$purchase->purchase_id])}}" class="pull-right">
									<button class="btn btn-success m-5"><b><i class="fa fa-plus"></i> PAY</b></button>
								</a>
							</div>
						</div>


						<table class="table table-bordered table-striped">
							<tr>
								<th>Payment Date</th>
								<th>Ref</th>
								<th>Ref Image</th>
								<th>Paymnet Mode</th>
								<th>Paymnet Amount</th>
							</tr>
							@foreach($purchase->purchase_payments as $p_payment)
							<tr>
								<td>{{\Carbon\Carbon::parse($p_payment->created_at)->format('d-m-Y')}}</td>
								<td>  {{$p_payment->ref ? $p_payment->ref : 'N/A'}}</td>
								<td> <img src="{{$p_payment->ref_image ? asset('uploads/'.$p_payment->ref_image) : asset('uploads/cheque.png')}}" height="200px" width="400px"></td>
								<td>  {{$p_payment->mode->payment_mode}}</td>
								<td> <i class="fa fa-inr"></i> {{$p_payment->paid_amount}}</td>
							</tr>
							@endforeach

							<tr class="text-success">
								<td align="right" colspan="4">Total Paid Amount:</td>
								<td><b><i class="fa fa-inr"></i> {{$purchase->purchase_payments->sum('paid_amount')}}</b></td>
							</tr>

							<tr class="text-danger">
								<td align="right" colspan="4">Total Remaining Amount:</td>
								<td><b><i class="fa fa-inr"></i> {{$purchase->purchase_amount->grand_total - $purchase->purchase_payments->sum('paid_amount')}}</b></td>
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

@section('script')

@endsection