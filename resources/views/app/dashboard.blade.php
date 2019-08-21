@extends('layouts.app')

{{--  Title  --}}
@section('title', 'Dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Welcome
			<small>to Techtool CRM</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>{{count($sells)}}</h3>

						<p>Sales</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="{{route('sell.add')}}" class="small-box-footer">Add new Sales <i class="fa fa-plus"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{count($customers)}}</h3>

						<p>Clients</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="{{route('customer.add')}}" class="small-box-footer">All new Clients <i class="fa fa fa-plus"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>{{count($purchasers)}}</h3>

						<p>Suppliers</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="{{route('purchaser.add')}}" class="small-box-footer">Add New Suppliers <i class="fa fa fa-plus"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3>{{count($purchases)}}</h3>

						<p>Purchase Orders</p>
					</div>
					<div class="icon">
						<i class="fa fa-cart-plus"></i>
					</div>
					<a href="{{route('purchase.add')}}" class="small-box-footer">All New Puchase <i class="fa fa fa-plus"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->
		<!-- Info boxes -->
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-product-hunt"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Product</span>
						<span class="info-box-number">{{count($products)}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-inr"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Receivable</span>
						<span class="info-box-number"><span class="fa fa-inr"></span> {{$sell_due}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->

			<!-- fix for small devices only -->
			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-inr"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Payable</span>
						<span class="info-box-number"><span class="fa fa-inr"></span> {{$purchase_due}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-truck"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Loories</span>
						<span class="info-box-number">{{count($lorries)}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- TABLE: LATEST ORDERS -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Product Inventory</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table no-margin">
						<thead>
							<tr>
								<th>Product</th>
								<th>Stock</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventories as $inventory)
							<tr>
								<td>{{$inventory->product->product_name}}</td>
								<td>{{$inventory->stock}} - {{$inventory->unit->unit_name}}</td>
								<td>
									@if( $inventory->stock < 10) <span class="label label-warning">Low Stock</span>
										@elseif( $inventory->stock < 1) <span class="label label-danger">Out Of Stock</span>
											@else
											<span class="label label-success">IN Stock</span>
											@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<a href="{{route('inventory')}}" class="btn btn-sm btn-primary btn-flat pull-right">View Inventory</a>
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection