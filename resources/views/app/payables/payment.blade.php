@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Payments
        <small>Add Payments</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Payments</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

        <!-- Alert Message -->
          @include('app.common.alert')
        {{-- End Alert Message --}}

        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Payments</h3>
              <!-- <a href="{{route('purchasers')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a> -->
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered table-striped">
              <tr>
                <td>Total Amount of PO</td>
                <td><i class="fa fa-inr"></i> {{$purchase->purchase_amount->grand_total}}</td>
              </tr>
              <tr class="text-success">
                <td>Paid Amount of PO</td>
                <td><i class="fa fa-inr"></i> {{$paid_amount}}</td>
              </tr>
              <tr class="text-danger">
                <td>Pending Amount of PO</td>
                <td><i class="fa fa-inr"></i> {{$remaining_amount}}</td>
              </tr>
            </table>
            <!-- form start -->
            <form method="POST" action="{{route('payables.payment.capture')}}" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
                {{-- Amount Paid --}}
                <div class="form-group {{ $errors->has('amount_paid') ? ' has-error' : '' }}">
                  <label for="amount_paid">Amount Paid
                  <span style="color: red;">*</span>
                  </label>
                  <input name="amount_paid" required type="text" class="form-control" id="amount_paid" placeholder="Enter Name Of Purchaser" value="{{old('amount_paid') }}">
                   	@if ($errors->has('amount_paid'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('amount_paid') }}</strong>
	                  </span>
                  	@endif
                </div>

                {{-- Payment Mode --}}
                <div class="form-group {{ $errors->has('payment_mode') ? ' has-error' : '' }}">
                  <label for="payment_mode">Payment Mode</label>
                  <span style="color: red;">*</span>

                  <select class="form-control" name="payment_mode" required >
                    <option selected="" disabled=""> Select Payment Mode</option>
                    @foreach($payment_modes as $payment_mode)
                      <option value="{{$payment_mode->payment_mode_id}}"> {{$payment_mode->payment_mode}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('payment_mode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('payment_mode') }}</strong>
                    </span>
                    @endif
                </div>


              {{-- Ref --}}
              <div class="form-group {{ $errors->has('referance') ? ' has-error' : '' }}">
                  <label for="referance">Referance</label>
                  <input name="referance" type="text" class="form-control" id="referance" placeholder="Referance of Payment" value="{{old('referance') }}">
                    @if ($errors->has('referance'))
                    <span class="help-block">
                        <strong>{{ $errors->first('referance') }}</strong>
                    </span>
                    @endif
                </div>

              {{-- Ref Image --}}
              <div class="form-group {{ $errors->has('ref_image') ? ' has-error' : '' }}">
                  <label for="ref_image">Ref Image</label>
                  <input name="ref_image" type="file" class="form-control" id="ref_image" placeholder="Referance Image" value="{{old('ref_image') }}">
                    @if ($errors->has('ref_image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ref_image') }}</strong>
                    </span>
                    @endif
              </div>

              <!-- Purchase ID -->
              <input type="hidden" name="purchase_id" value="{{$purchase->purchase_id}}">
              <input type="hidden" name="remaining_amount" value="{{$remaining_amount}}">

            </div>


              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Payment</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection