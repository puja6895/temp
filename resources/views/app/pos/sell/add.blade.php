@extends('layouts.app')

{{--  Title  --}}
@section('title', 'Add new sales')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <div class="loading">Loading&#8230;</div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sell
        <small>Add Sell</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sell</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

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
        @elseif (count($errors) > 0)
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> {{$errors->first() }}
          </div>
        @endif
        {{-- End Alert Message --}}

        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Sell</h3>
              <a href="{{route('sell')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('sell.store')}}">
            @csrf
              <div class="box-body">

                <div class="row">
                  {{-- Sell To Name --}}
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                      <label>Customer <span style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                          <select class="form-control select2" name="customer_id">
                            <option selected="" disabled="">Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                            @endforeach
                          </select>

                          @if ($errors->has('customer_id'))
                          <span class="help-block">
                              <strong>{{ $errors->first('customer_id') }}</strong>
                          </span>
                          @endif
                      </div>
                    </div>
                  </div>

                  <!--Purchase DATE  -->
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                      <label>Sell Date <span style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="sell_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                        @if ($errors->has('sell_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sell_date') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="alert alert-error alert-dismissible" role="alert" style="display: none" id="js_error_panel">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> <span id="js_error"></span>
                </div>

                <div class="row">
                  <div class="col-md-12 table-responsive">
                    <div class="row">
                      <div class="col-md-6">
                        <h4> ADD Products/Material</h4>
                      </div>
                      <div class="col-md-6 pull-right">

                      </div>
                    </div>
                    <table class="table table-bordered" id="">
                      <thead>
                        <tr>
                          <th class="col-md-2">Product</th>
                          <th class="col-md-1">Unit</th>
                          <th class="col-md-2">Rate</th>
                          <th class="col-md-2">Quantity(
                            <span id="available_stock">
                              0
                            </span>)</th>
                          <th class="col-md-2">GST</th>
                          <th class="col-md-2">Total</th>
                          <th class="col-md-1">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="col-md-2">
                            <select required name="product_id0" id="product_id0" class="form-control select2" onchange="setDefault()">
                              <option value="0"> Product </option>
                              @foreach($products as $product)
                                <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td class="col-md-1">
                            <select required name="unit_id0" id="unit_id0" class="form-control select2" readonly>
                              <option value="0"> Unit </option>
                              @foreach($units as $unit)
                                <option value="{{$unit->unit_id}}">{{$unit->unit_name}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td class="col-md-2">
                             <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="fa fa-inr"></i>
                                </span>
                                <input type="text" class="form-control" name="rate0" id="rate0" onchange="claculateTotal()" required value="0">
                              </div>
                          </td>
                          <td class="col-md-2">
                            <input class="col-sm-12" type="number" name="quantity0" id="quantity0" value="1" required onkeyup="claculateTotal()">

                          </td>
                          <td class="col-md-2">
                            <div class="input-group">
                              <input type="text" class="form-control" name="gst0" id="gst0" onkeyup="claculateTotal()" required value="0">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                          <td class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="fa fa-inr"></i>
                                </span>
                                <input type="text" class="form-control" name="total0" id="total0" readonly value="0">
                              </div>
                          </td>
                          <td class="col-md-1">
                            <!-- <button type="button" class="btn btn-xs btn-danger ibtnDel">
                              <i class="fa fa-trash"></i>
                            </button> -->
                            <button type="button" id="addrow" class="btn  btn-success pull-right">
                              <i class="fa fa-plus"></i> Add
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-12 table-responsive">
                    <table class="table table-bordered" id="purchaseTable">
                      <tr>
                        <th class="col-md-2">Product</th>
                        <th class="col-md-2">Unit</th>
                        <th class="col-md-2">Rate</th>
                        <th class="col-md-2">Quantity</th>
                        <th class="col-md-2">GST</th>
                        <th class="col-md-2">Total</th>
                        <th class="col-md-2">Action</th>
                      </tr>
                    </table>
                  </div>
                </div>

              </div>

              <!-- <hr>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered">
                    <tr>
                      <td colspan="6" align="right">SubTotal</td>
                      <td><b>
                        <i class="fa fa-inr"></i><span id="subTotal"> 0 </span>
                      </b></td>
                    </tr>
                    <tr>
                      <td colspan="6" align="right">GST</td>
                      <td><b>
                        <i class="fa fa-inr"></i><span id="totalGst">0</span>
                      </b>
                    </td>
                    </tr>
                    <tr>
                      <td colspan="6" align="right">Grand Total</td>
                      <td><b>
                        <i class="fa fa-inr"></i><span id="grandTotal">0</span>
                      </b>
                    </td>
                    </tr>
                  </table>
                </div>
              </div> -->
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Save</button>
                <a href="{{route('purchase')}}"><button type="button" class="btn btn-primary"> <i class="fa fa-times"></i> Cancel</button></a>
              </div>
            </form>
            </div>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('custom/sell.js')}}"></script>

@endsection