@extends('layouts.app')

{{--  Title  --}}
@section('title', 'Add Purchase')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <div class="loading">Loading&#8230;</div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase
        <small>Add Purchase</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase</li>
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
        @endif
        {{-- End Alert Message --}}

        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Purchase</h3>
              <a href="{{route('purchase')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('purchase.store')}}">
            @csrf
              <div class="box-body">

                <div class="row">
                  {{-- Purchase From Name --}}
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('purchaser_id') ? ' has-error' : '' }}">
                      <label>Purchaser <span style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                          <select class="form-control" name="purchaser_id">
                            <option selected="" disabled="">Select Purchaser</option>
                            @foreach($purchasers as $purchaser)
                            <option value="{{$purchaser->purchaser_id}}">{{$purchaser->purchaser_name}}</option>
                            @endforeach
                          </select>

                          @if ($errors->has('purchaser_id'))
                          <span class="help-block">
                              <strong>{{ $errors->first('purchaser_id') }}</strong>
                          </span>
                          @endif
                      </div>
                    </div>
                  </div>

                  <!--Purchase DATE  -->
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                      <label>Purchase Date <span style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="purchase_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                        @if ($errors->has('purchase_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('purchase_date') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <!--Purchase DATE  -->
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('due_date') ? ' has-error' : '' }}">
                      <label>Due Date <span style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="due_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                        @if ($errors->has('due_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('due_date') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('order_number') ? ' has-error' : '' }}">
                      <label>Order Number <span style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-gift"></i>
                        </div>
                        <input type="text" name="order_number" class="form-control"  required="" placeholder="Ref Order Number">
                        @if ($errors->has('order_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('order_number') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>

                </div>

                <hr>
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
                          <th class="col-md-3">Product</th>
                          <th class="col-md-1">Unit</th>
                          <th class="col-md-2">Rate</th>
                          <th class="col-md-1">Quantity</th>
                          <th class="col-md-2">GST</th>
                          <th class="col-md-2">Total</th>
                          <th class="col-md-1">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="col-md-3">
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
                          <td class="col-md-1">
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
<script type="text/javascript" src="{{asset('custom/purchase.js')}}"></script>

@endsection