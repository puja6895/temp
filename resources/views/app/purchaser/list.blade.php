@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchaser
        <small>All Purchaser</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchaser</li>
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
              <h3 class="box-title">Purchaser</h3>
              <a href="{{route('purchaser.add')}}" class="pull-right">
              	<button class="btn btn-info"><b>Add New+</b></button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Purchaser Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Company</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchasers as $purchaser)
                <tr>
                  <td>{{$purchaser->purchaser_name}}</td>
                  <td>{{$purchaser->purchaser_mobile}}</td>
                  <td>{{$purchaser->purchaser_email ? $purchaser->purchaser_email : 'N/A'}}</td>
                  <td>{{$purchaser->company ? $purchaser->company : 'N/A'}}</td>
                  <td>{{$purchaser->purchaser_address ? $purchaser->purchaser_address : 'N/A'}}</td>
                  <td>
                  	@if($purchaser->purchaser_status == 1)
                  		<label class="label label-success">Active</label>
                  	@else
                  		<label class="label label-danger">Inactive</label>
                  	@endif
                  </td>
                  <td>
                  	<a href="{{route('purchaser.edit',['id'=>$purchaser->purchaser_id])}}">
                  		<button class="btn btn-sm btn-info">Edit</button>
                  	</a>
                  	@if($purchaser->purchaser_status == 1)
                  		<a href="{{route('purchaser.status',['id'=>$purchaser->purchaser_id])}}">
                  			<button class="btn btn-sm btn-danger">Disable</button>
                  		</a>
                  	@else
                  		<a href="{{route('purchaser.status',['id'=>$purchaser->purchaser_id])}}">
                  			<button class="btn btn-sm btn-success">Enable</button>
                  		</a>
                  	@endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Purchaser Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Company</th>
                  <th>Address</th>
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