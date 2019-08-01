@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory
        <small>Log</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory Log</li>
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
              <h3 class="box-title">Inventory Log</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Product Name</th>
                  <th>Type</th>
                  <th>Credit</th>
                  <th>Debit</th>
                  <th>Created By</th>
                  <th>Comment</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inv_logs as $index => $inv_log)
                <tr>
                  <td>{{\Carbon\Carbon::parse($inv_log->created_at)->format('d-m-Y')}}</td>
                  <td>{{$inv_log->product->product_name}}</td>
                  <td>
                    @if($inv_log->type == 1)
                      <label class="label label-success">Purchase</label>
                    @elseif($inv_log->type == 2)
                      <label class="label label-success">Sell</label>
                    @elseif($inv_log->type == 3)
                      <label class="label label-success">Inventory</label>
                    @endif
                  </td>
                  <td>{{$inv_log->credit}} ({{$inv_log->unit->unit_name}})</td>
                  <td>{{$inv_log->debit}} ({{$inv_log->unit->unit_name}})</td>
                  <td>{{$inv_log->user->name}}</td>
                  <td>{{$inv_log->comment}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Sr.No</th>
                  <th>Product Name</th>
                  <th>Type</th>
                  <th>Credit</th>
                  <th>Debit</th>
                  <th>Created By</th>
                  <th>Comment</th>
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