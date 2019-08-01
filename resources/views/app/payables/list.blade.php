@extends('layouts.app')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Financials
			<small>Payables</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Payables</li>
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
				<table class="table table-bordered" >
			              <tr class="text-primary text-center">
			                <td><b>Total Amount</b></td>
			                <td><b>Paid Amount</b></td>
			                <td><b>Pending Amount</b></td>
			              </tr>
			              <tr class="text-center">
			                <td><b> <h1><i class="fa fa-inr"></i> {{$total_amount}}</h1></b></td>
			                <td class="text-success"><b><h1><i class="fa fa-inr"></i> {{$paid_amount}}</h1></b></td>
			                <td class="text-danger"><b><h1><i class="fa fa-inr"></i> {{$total_amount - $paid_amount}}</h1></b></td>
			              </tr>
			            </table>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Payables</h3>
						<!-- <a href="{{route('purchase.add')}}" class="pull-right">
							<button class="btn btn-info"><b>Add New+</b></button>
						</a> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">

						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Purchase From</th>
									<th>Purchase Date</th>
									<th>Due Date</th>
									<th>Amount Due</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($purchases as $purchase)
								<tr>
									<td>{{$purchase->purchaser->purchaser_name}}</td>
									<td>{{\Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y')}}</td>
									<td>{{\Carbon\Carbon::parse($purchase->due_date)->format('d-m-Y')}}</td>
									<td> <b><i class="fa fa-inr"></i> {{$purchase->purchase_amount->grand_total - $purchase->purchase_payments->sum('paid_amount')}} </b></td>
									<td>
										@if($purchase->purchase_status == 1)
										<label class="label label-danger">
											Pending
										</label>
										@elseif($purchase->purchase_status == 2)
										<label class="label label-warning">
											Partial
										</label>
										@elseif($purchase->purchase_status == 3)
										<label class="label label-success">
											Paid
										</label>
										@else
										<label class="label label-info">
											N/A
										</label>
										@endif

									</td>
									<td>
										<a href="{{route('purchase.show',['id'=>$purchase->purchase_id])}}">
											<button class="btn btn-sm btn-success">View</button>
										</a>
										<a href="{{route('payables.payment',['purchase_id'=>$purchase->purchase_id])}}">
                  		<button class="btn btn-sm btn-info">PAY</button>
                  	</a>
									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>Purchase From</th>
									<th>Purchase Date</th>
									<th>Due Date</th>
									<th>Amount Due</th>
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