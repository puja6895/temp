@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lorries
        <small>All Lorries</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lorries</li>
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
              <h3 class="box-title">Lorries</h3>
              <a href="{{route('lorry.add')}}" class="pull-right">
              	<button class="btn btn-info"><b>Add New+</b></button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Lorry Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lorries as $lorry)
                <tr>
                  <td>{{$lorry->lorry_name}}</td>
                  <td>
                  	@if($lorry->lorry_status == 1)
                  		<label class="label label-success">Active</label>
                  	@else
                  		<label class="label label-danger">Inactive</label>
                  	@endif
                  </td>
                  <td>
                  	<a href="{{route('lorry.edit',['id'=>$lorry->lorry_id])}}">
                  		<button class="btn btn-sm btn-info">Edit</button>
                  	</a>
                  	@if($lorry->lorry_status == 1)
                  		<a href="{{route('lorry.status',['id'=>$lorry->lorry_id])}}">
                  			<button class="btn btn-sm btn-danger">Disable</button>
                  		</a>
                  	@else
                  		<a href="{{route('lorry.status',['id'=>$lorry->lorry_id])}}">
                  			<button class="btn btn-sm btn-success">Enable</button>
                  		</a>
                  	@endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Lorry Name</th>
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